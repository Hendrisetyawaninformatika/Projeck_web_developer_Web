<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\FirebaseAuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $result = $this->firebaseAuth->signIn(
            $request->email,
            $request->password
        );

        if (!$result['success']) {
            return back()->with('error', $result['error']);
        }

        // Simpan ke session
        Session::put('firebase_id_token', $result['id_token']);
        Session::put('firebase_uid', $result['uid']);

        // Cari atau buat user di database lokal
        $user = User::where('firebase_uid', $result['uid'])->first();
        
        if (!$user) {
            $firebaseUser = $this->firebaseAuth->getUser($result['uid']);
            $user = User::create([
                'name' => $firebaseUser['displayName'] ?? 'User',
                'email' => $firebaseUser['email'],
                'firebase_uid' => $result['uid'],
                'role' => 'user',
                'photo_url' => $firebaseUser['photoUrl'] ?? null,
            ]);
        }

        auth()->login($user);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Session::forget(['firebase_id_token', 'firebase_uid']);
        auth()->logout();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}