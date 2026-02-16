<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
       /**
     * Display a listing of the users.
     */
    public function index()
    {
        //$users = User::all();  // Fetch all users
        $users = User::where('status',1)->where('role','admin')->get();
        $user_role = ['admin', 'customer'];
        return view('pages.dashboard.users.index', compact('users','user_role'));  // Return the users list view
    }

    /**
     * Show the form for creating a new user.
     */
    public function add()
    {

        $user_role = ['admin', 'customer'];
        return view('pages.dashboard.users.create',compact('user_role'));  // Return the create user view
    }

    /**
     * Store a newly created user in the database.
     */
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'customer'])],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a specific user.
     */
    public function edit($id)
    {
        $user_role = ['admin', 'customer'];
        $user = User::findOrFail($id);  // Find the user by ID
        return view('pages.dashboard.users.edit', compact('user','user_role'));  // Return the edit user view
    }

    /**
     * Update the user in the database.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);  // Find the user by ID

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Exclude current email from validation
            'username' => 'required|string|max:255|unique:users,username,' . $user->id, // Exclude current username from validation
            'role' => ['required', Rule::in(['admin', 'customer'])],
            'password' => 'nullable|string|min:8', // Make password nullable, so it's not required if not provided
        ]);

        //dd($request->all());

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'status' => $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete the user from the database.
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);  // Find the user by ID
        $user->delete();  // Delete the user

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
