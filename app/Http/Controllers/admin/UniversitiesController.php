<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Programme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UniversitiesController extends Controller
{
    // Show all According records
    public function index()
    {
        $universities = University::where('status',1)->orderBy('order','asc')->get();
        $pages = Programme::where('status',1)->where('type','study_abroad')->get();
        return view('pages.dashboard.page-study-abroad.universities', compact('universities','pages'));
    }

    // Show create form
    public function create()
    {
        $universities = University::where('status',1)->where('type','programme')->get();
        $programmes = Programme::where('status',1)->get();
        return view('pages.dashboard.programme.createaccording', compact('accordings','programmes'));
    }

    // Store new According
    public function store(Request $request)
    {
        if (!$request->isMethod('post')) {
            return back()->with('error', 'Invalid request method.');
        }

        $validator = Validator::make($request->all(), [
            'topic' => 'required|string|max:255',
            'sub_topic' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

         if ($validator->fails()) {
            return back()
                ->withErrors($validator) // adds errors to the session
                ->withInput() // keeps the old input data
                ->with('error', 'Please fix the validation errors.'); // custom general message
        }

        University::create([
            'topic' => $request->topic,
            'sub_topic' => $request->sub_topic,
            'section' => $request->section,
            'type' => 'programme',
            'page_id' => $request->page_id,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->has('switch_publish') ? 1 : 0,
        ]);

        return redirect()->route('admin.accordings')->with('success', 'Item created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $according = University::findOrFail($id);

        if($according->type != 'programme'){
            return back()->with('error', 'Invalid request.');
        }

        $programmes = Programme::where('status',1)->get();
        //dd($programmes);
        return view('pages.dashboard.programme.editaccording', compact('according', 'programmes'));
    }

    // Update According
    public function update(Request $request, $id)
    {

        if (!$request->isMethod('post')) {
            return back()->with('error', 'Invalid request method.');
        }

        $validator = Validator::make($request->all(), [
            'topic' => 'required|string|max:255',
            'sub_topic' => 'nullable|string|max:255',
            'page_id' => 'required|integer',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

         if ($validator->fails()) {
            return back()
                ->withErrors($validator) // adds errors to the session
                ->withInput() // keeps the old input data
                ->with('error', 'Please fix the validation errors.'); // custom general message
        }

        $according = University::findOrFail($id);
        $according->update([
            'topic' => $request->topic,
            'sub_topic' => $request->sub_topic,
            'section' => $request->section,
            'page_id' => $request->page_id,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->has('switch_publish') ? 1 : 0,
        ]);

        return redirect()->route('admin.accordings')->with('success', 'Item updated successfully.');
    }

    public function updateOrder(Request $request,$id)
    {
        //dd($request->all());
        $partner = University::findOrFail($id);
        $partner->update([
            'order' => $request->order_no_current ?? 0,
        ]);

        return redirect()->route('admin.accordings')->with('success', 'Order Number updated successfully.');
    }

    public function updateSectionID(Request $request,$id)
    {
        //dd($request->all());
        $partner = University::findOrFail($id);
        $partner->update([
            'section' => $request->section_no_current ?? 0,
        ]);

        return redirect()->route('admin.accordings')->with('success', 'Section Number updated successfully.');
    }

     public function updatePageID(Request $request,$id)
    {
        //dd($request->all());
        $partner = University::findOrFail($id);
        $partner->update([
            'page_id' => $request->page_no_current ?? 0,
        ]);

        return redirect()->route('admin.accordings')->with('success', 'Page ID is updated successfully.');
    }
    // Delete According
    public function delete($id)
    {
        $according = University::findOrFail($id);
        $according->delete();
        return redirect()->route('admin.accordings')->with('success', 'Item deleted successfully.');
    }
}
