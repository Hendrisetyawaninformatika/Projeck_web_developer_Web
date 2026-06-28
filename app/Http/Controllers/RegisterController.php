<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\FirebaseAuthService;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        // Buat user di Firebase
        $result = $this->firebaseAuth->createUser(
            $request->email,
            $request->password,
            $request->name
        );

        if (!$result['success']) {
            return back()->with('error', $result['error'])->withInput();
        }

        // Buat user di database lokal
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Backup lokal
            'phone' => $request->phone,
            'firebase_uid' => $result['uid'],
            'role' => 'user',
        ]);

        // Auto login
        auth()->login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil!');
    }
}