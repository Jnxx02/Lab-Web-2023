<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $users = User::where('role', '!=', 'admin')->get();
                return view('dashboard.admin.user-list', compact('users'));
            }
        }
        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('dashboard.admin.create-user');
        }
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|min:8|same:password',
            ], [
                'name.required' => 'Nama harus diisi',
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username sudah terdaftar',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'role.required' => 'Role harus diisi',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password_confirmation.required' => 'Konfirmasi password harus diisi',
                'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter',
                'password_confirmation.same' => 'Konfirmasi password tidak sama',
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);
            return redirect()->to('user')->with('success', 'User berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $selectedUser = User::where('id', $id)->get();
        return view('dashboard.admin.edit-user', compact('selectedUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'email' => "required|email|unique:users,email,$id",
                'role' => 'required',
            ], [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'role.required' => 'Role harus diisi',
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ];

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            User::where('id', $id)->update($data);
            return redirect()->to('user')->with('success', 'Data berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            User::where('id', $id)->delete();
            return redirect()->to('user')->with('success', "Data User dengan Id $id berhasil dihapus");
        }
    }
}
