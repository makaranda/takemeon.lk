<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\MusicTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicTracksController extends Controller
{
    public function index()
    {
        $musicTracks = MusicTrack::all();  // Fetch all music tracks
        return view('pages.dashboard.music-tracks.index', compact('musicTracks'));  // Return the music tracks list view
    }

    /**
     * Show the form for creating a new music track.
     */
    public function add()
    {
        return view('pages.dashboard.music-tracks.create');  // Return the add music track form view
    }

    /**
     * Store a newly created music track in the database.
     */
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'track_type' => 'required|string|in:audio,video,beat',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'order' => 'nullable|integer|min:0',
            'fileup' => $request->track_type === 'video' ? 'nullable|string' : 'required|mimes:mp3,wav|max:10000',
            'file_input' => $request->track_type === 'beat' ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240' : 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $lastTrack = MusicTrack::latest('id')->first();
        $nextNumber = $lastTrack ? $lastTrack->id + 1 : 1;

        $prefix = match ($request->track_type) {
            'audio' => 'AUD',
            'video' => 'VID',
            'beat' => 'BET',
            default => 'UNK',
        };

        $track_code = sprintf('%s%04d', $prefix, $nextNumber);

        // Initialize file paths
        $trackPath = '';
        $trackImagePath = 'default_image.jpg';

        // Save Audio/Beat File
        if ($request->track_type !== 'video' && $request->hasFile('fileup')) {
            $filePath = 'assets/frontend/audios/';
            $trackFile = $request->file('fileup');
            $filename = $request->track_type . '_' . time() . '.' . $trackFile->getClientOriginalExtension();
            
            if ($trackFile->move(public_path($filePath), $filename)) {
                $trackPath = $filename;
            }
        } elseif ($request->track_type === 'video') {
            $trackPath = $request->video_url;
        }
        
        $img_folder = ($request->track_type == 'video') ? 'video' : 'music_man';

        // Save Image for Beat Track
        if ($request->hasFile('file_input')) {
            $imagePath = 'assets/frontend/img/'.$img_folder.'/';
            $file_input = $request->file('file_input');
            $imageFilename = $request->track_type . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($imagePath), $imageFilename)) {
                $trackImagePath = $imagePath . $imageFilename;
            }
        }

        // Save to Database
        MusicTrack::create([
            'track_code' => $track_code,
            'title' => $request->title,
            'sub_title' => $request->short_title,
            'link' => $request->link,
            'description' => '',
            'track' => $trackPath ?? '',
            'track_image' => $trackImagePath ?? 'default_image.jpg',
            'type' => $request->track_type,
            'price' => $request->price,
            'qty' => $request->qty,
            'order' => $request->order ?? 0,
            'author_id' => Auth::user()->id,
            'status' => $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.musictracks')->with('success', 'Music track created successfully.');
    }


    /**
     * Show the form for editing the specified music track.
     */
    public function edit($id)
    {
        $musicTrack = MusicTrack::findOrFail($id);  // Find the music track by ID
        return view('pages.dashboard.music-tracks.edit', compact('musicTrack'));  // Return the edit form with the music track data
    }

    /**
     * Update the specified music track in the database.
     */
    public function update(Request $request, $id)
    {
        $musicTrack = MusicTrack::findOrFail($id);  // Find the music track by ID

        $request->validate([
            'title' => 'required|string|max:255',
            'track_type' => 'required|string|in:audio,video,beat',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'order' => 'nullable|integer|min:0',
        ]);

        $trackPath = '';
        $trackImagePath = '';
        
        $img_folder = ($request->track_type == 'video') ? 'video' : 'music_man';

        if ($request->hasFile('file_input')) {
            $filePath = 'public/assets/frontend/img/'.$img_folder.'/';
            if ($musicTrack->track_image) {
                $existingImagePath = $filePath . $musicTrack->track_image;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/img/'.$img_folder.'/';
            $file_input = $request->file('file_input');
            $filename = $request->track_type . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $trackImagePath = $filename;
            } else {
                $trackImagePath = $musicTrack->track_image ?? 'default_image.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $trackImagePath = $musicTrack->track_image ?? 'default_image.jpg';
        }

        if ($request->hasFile('fileup')) {
            $filePath = 'public/assets/frontend/audios/';
            if ($musicTrack->track) {
                $existingImagePath = $filePath . $musicTrack->track;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/audios/';
            $file_input = $request->file('fileup');
            $filename = $request->track_type . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $trackPath = $filename;
            } else {
                $trackPath= $musicTrack->track;
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $trackPath= $musicTrack->track;
        }

        // Update music track record
        $musicTrack->update([
            'title' => $request->title,
            'sub_title' => $request->short_title,
            'link' => $request->link ?? '',
            'description' => '',
            'track' => $trackPath ?? '',
            'track_image' => $trackImagePath ?? 'default_image.jpg',
            'type' => $request->track_type,
            'price' => $request->price,
            'qty' => $request->qty,
            'order' => $request->order ?? 0,
            'author_id' => Auth::user()->id,
            'status' => $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.musictracks')->with('success', 'Music track updated successfully.');
    }

    /**
     * Remove the specified music track from the database.
     */
    public function delete($id)
    {
        $musicTrack = MusicTrack::findOrFail($id);  // Find the music track by ID

        // Delete associated files from storage
        //Storage::disk('public')->delete($musicTrack->track);
        //Storage::disk('public')->delete($musicTrack->track_image);

        // Delete the music track record
        $musicTrack->delete();

        return redirect()->route('admin.musictracks')->with('success', 'Music track deleted successfully.');
    }
}
