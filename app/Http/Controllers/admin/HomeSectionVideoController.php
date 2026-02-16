<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSectionVideoController extends Controller
{
    public function index(Request $request, $id)
   {
       //var_dump(session('success'));
       $page = Page::where('status',1)->where('id',$id)->first();
       //dd($page->id);
       return view('pages.dashboard.home-video.edit', compact('page'));
   }
     // Update main slider
   public function update(Request $request, $id)
   {
    //dd($request->all());
    if (!$request->isMethod('put')) {
        return back()->with('error', 'Invalid request method.');
    }

       $request->validate([
            'file_input' => 'nullable|mimes:mp4,avi,mov,wmv|max:14048',
            'title' => 'required|string|max:255',
            'link' => 'required',
            'description' => 'required',
            'switch_publish' => 'nullable',
       ]);

       $page = Page::findOrFail($id);
       $homeVideoPath = '';
       if ($request->hasFile('file_input')) {
            $filePath = 'public/assets/frontend/videos/';
            if ($page->video) {
                $existingVideoPath = $filePath . $page->video;
                if (file_exists($existingVideoPath)) {
                    unlink($existingVideoPath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/videos/';
            $file_input = $request->file('file_input');
            $filename = 'home_video_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $homeVideoPath = $filename;
            } else {
                $homeVideoPath = $page->video ?? 'our-university-story.mp4';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $homeVideoPath = $page->video ?? 'our-university-story.mp4';
        }

        $page->update([
            'video' => $homeVideoPath,
            'link' => $request->link ?? '',
            'title' => $request->title ?? '',
            'description' => $request->description ?? '',
            'status' => $request->has('switch_publish') ? 1 : 0,
        ]);

       return redirect()->route('admin.homesecvideo',$id)->with('success', 'Home Video Section updated successfully');
       //session()->flash('success', 'Slider updated successfully');
       //return redirect()->route('admin.mainslider');
       //session()->flash('success', 'Slider updated successfully');

       //dd(session()->all());
       //return back()->with('success', 'Slider updated successfully');
   }
}
