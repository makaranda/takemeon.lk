<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadsController extends Controller
{
    public function index()
    {
        $uploads = Upload::latest()->paginate(15);
        return view('pages.dashboard.uploads.index', compact('uploads'));
    }

    public function create()
    {
        return view('pages.dashboard.uploads.create');
    }

    public function store(Request $request)
{
        $request->validate([
            'type' => 'required|in:image,document,media',
            'file_input' => 'required|file|max:10240', // max 10MB
        ]);

        $file = $request->file('file_input');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = public_path('assets/uploads/pages/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file->move($path, $filename);
        //dd($request->all());
        Upload::create([
            'type' => $request->type,
            'file_name' => $filename,
            'author_id' => auth()->user()->id,
            'order' => $request->order,
            'status' => $request->switch_publish ? 1 : 0,
        ]);

        return redirect()->route('admin.uploads')->with('success', 'File uploaded successfully.');
    }

    public function edit($id)
    {
        $upload = Upload::findOrFail($id);
        return view('pages.dashboard.uploads.edit', compact('upload'));
    }

    public function update(Request $request, $id)
    {
        $upload = Upload::findOrFail($id);

        $request->validate([
            'type' => 'required|in:image,document,media',
            'file_input' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file_input')) {
            $file = $request->file('file_input');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/uploads/pages/'), $filename);

            // delete old file
            $oldFilePath = public_path('assets/uploads/pages/' . $upload->file_name);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $upload->file_name = $filename;
        }

        $upload->type = $request->type;
        $upload->author_id = auth()->user()->id;
        $upload->order = $request->order;
        $upload->status = $request->switch_publish ? 1 : 0;
        $upload->save();

        return redirect()->route('admin.uploads')->with('success', 'Upload updated.');
    }

    public function delete($id)
    {
        $upload = Upload::findOrFail($id);

        $filePath = public_path('assets/uploads/pages/' . $upload->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $upload->delete();

        return redirect()->route('admin.uploads')->with('success', 'Upload deleted.');
    }
}
