<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\According;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class HomeSectionAccordingController extends Controller
{
    // Show all According records
    public function index()
    {
        $accordings = According::where('type','home')->orderBy('order','asc')->get();
        return view('pages.dashboard.home-according.index', compact('accordings'));
    }

    // Show create form
    public function create()
    {
        $accordings = According::where('status',1)->where('type','home')->get();
        return view('pages.dashboard.home-according.create', compact('accordings'));
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

        According::create([
            'topic' => $request->topic,
            'sub_topic' => $request->sub_topic,
            'type' => 'home',
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->has('switch_publish') ? 1 : 0,
        ]);

        return redirect()->route('admin.homesecaccording')->with('success', 'Item created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $according = According::findOrFail($id);
        return view('pages.dashboard.home-according.edit', compact('according'));
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

        $according = According::findOrFail($id);
        $according->update([
            'topic' => $request->topic,
            'sub_topic' => $request->sub_topic,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->has('switch_publish') ? 1 : 0,
        ]);

        return redirect()->route('admin.homesecaccording')->with('success', 'Item updated successfully.');
    }

    public function updateOrder(Request $request,$id)
    {
        //dd($request->all());
        $partner = According::findOrFail($id);
        $partner->update([
            'order' => $request->order_no_current ?? 0,
        ]);

        return redirect()->route('admin.homesecaccording')->with('success', 'Order Number updated successfully.');
    }
    // Delete According
    public function delete($id)
    {
        $according = According::findOrFail($id);
        $according->delete();
        return redirect()->route('admin.homesecaccording')->with('success', 'Item deleted successfully.');
    }
}
