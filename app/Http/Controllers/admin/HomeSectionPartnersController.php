<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class HomeSectionPartnersController extends Controller
{
   public function index()
    {
        $partners = Partner::orderBy('order')->get();
        return view('pages.dashboard.home-partners.index', compact('partners'));
    }

    // Show create form
    public function create()
    {
        $partners = Partner::where('status',1)->get();
        return view('pages.dashboard.home-partners.create', compact('partners'));
    }

    // Store new partner
    public function store(Request $request)
    {

        if (!$request->isMethod('post')) {
            return back()->with('error', 'Invalid request method.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'order' => 'nullable|integer',
            'file_input' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

         if ($validator->fails()) {
            return back()
                ->withErrors($validator) // adds errors to the session
                ->withInput() // keeps the old input data
                ->with('error', 'Please fix the validation errors.'); // custom general message
        }

        $imagePath = null;
        //dd($request->all());
        if ($request->hasFile('file_input')) {
            $uploadPath = 'assets/images/partner/';
            $file = $request->file('file_input');
            $filename = 'partner_' . time() . '.' . $file->getClientOriginalExtension();

            if ($file->move(public_path($uploadPath), $filename)) {
                $imagePath = $filename;
            }
        }

        Partner::create([
            'title' => $request->title,
            'web_link' => $request->web_link ?? '#',
            'order' => $request->order ?? 0,
            'status' => $request->has('switch_publish') ? 1 : 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.homesecpartners')->with('success', 'Partner created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('pages.dashboard.home-partners.edit', compact('partner'));
    }

    // Update partner
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        //dd($partner->title);

        if (!$request->isMethod('post')) {
            return back()->with('error', 'Invalid request method.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'order' => 'nullable|integer',
            'file_input' => (empty($partner->image) ? 'required|' : '') .'|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

         if ($validator->fails()) {
            return back()
                ->withErrors($validator) // adds errors to the session
                ->withInput() // keeps the old input data
                ->with('error', 'Please fix the validation errors.'); // custom general message
        }

        $imagePath = $partner->image;

        if ($request->hasFile('file_input')) {
            $uploadPath = 'assets/images/partner/';
            $file = $request->file('file_input');
            $filename = 'partner_' . time() . '.' . $file->getClientOriginalExtension();

            // Delete old image
            $oldPath = public_path($uploadPath . $partner->image);
            if ($partner->image && File::exists($oldPath)) {
                File::delete($oldPath);
            }

            if ($file->move(public_path($uploadPath), $filename)) {
                $imagePath = $filename;
            }
        }
        //dd($request->all());
        $partner->update([
            'title' => $request->title,
            'web_link' => $request->web_link ?? '#',
            'order' => $request->order ?? 0,
            'status' => $request->has('switch_publish') ? 1 : 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.homesecpartners')->with('success', 'Partner updated successfully.');
    }

    public function updateOrder(Request $request,$id)
    {
        //dd($request->all());
        $partner = Partner::findOrFail($id);
        $partner->update([
            'order' => $request->order_no_current ?? 0,
        ]);

        return redirect()->route('admin.homesecpartners')->with('success', 'Partner Order Number updated successfully.');
    }

    // Delete partner
    public function delete($id)
    {
        $partner = Partner::findOrFail($id);
        $imagePath = public_path('assets/images/partner/' . $partner->image);

        if ($partner->image && File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $partner->delete();
        return redirect()->route('admin.homesecpartners')->with('success', 'Partner deleted successfully.');
    }
}
