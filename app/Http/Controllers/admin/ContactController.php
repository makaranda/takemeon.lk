<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    // Show all pages
    public function index()
    {
        $contacts = ContactUs::where('status',1)->get();
        return view('pages.dashboard.contacts.index', compact('contacts'));
    }

    // Show create form
    public function create()
    {
        $contacts = ContactUs::all();
        return view('pages.dashboard.contacts.create', compact('contacts'));
    }

    public function edit($id){
        $contact = ContactUs::findOrFail($id);
        return view('pages.dashboard.contacts.edit', compact('contact'));
    }

    public function view($id){
        $contact = ContactUs::findOrFail($id);
        return view('pages.dashboard.contacts.view', compact('contact'));
    }
    public function delete($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->status = 0; // Set status to 0 (inactive or deleted status)
        $contact->save(); // Save the updated record

        return redirect()->route('admin.contacts')->with('success', 'Contact marked as inactive successfully');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'mac_address' => 'required|string|max:255',
            'device' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Find the page by ID
        $page = \App\Models\ContactUs::findOrFail($id);

        // Update page data
        $page->name = $request->name;
        $page->phone = $request->phone; // Updated to match the input field
        $page->email = $request->email;
        $page->ip_address = $request->ip_address;
        $page->mac_address = $request->mac_address;
        $page->device = $request->device;
        $page->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Save the updated page
        $page->save();

        // Redirect or return response
        return redirect()->route('admin.contacts')->with('success', 'Contact updated successfully');
    }
}
