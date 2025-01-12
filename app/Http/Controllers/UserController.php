<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'auditor')->get();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
        // Log the incoming request data
        \Log::info('Request data: ', $request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Create a new user instance
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => 'auditor',
            ]);

            // Log success message
            \Log::info('User created successfully: ', $user->toArray());

            // Redirect to the users index page with a success message
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Error creating user: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error creating user.']);
        }
    }
    public function edit($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan halaman edit
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$id}",
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            // Cari user berdasarkan ID
            $user = User::findOrFail($id);

            // Update data user
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];

            if (!empty($validatedData['password'])) {
                $user->password = bcrypt($validatedData['password']);
            }

            $user->save();

            // Redirect dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            // Log error dan redirect kembali dengan pesan error
            \Log::error('Error updating user: ' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors(['error' => 'Error updating user.']);
        }
    }
    public function destroy($id)
    {
        try {
            // Cari user berdasarkan ID
            $user = User::findOrFail($id);

            // Hapus user
            $user->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Log error dan redirect kembali dengan pesan error
            \Log::error('Error deleting user: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

}
