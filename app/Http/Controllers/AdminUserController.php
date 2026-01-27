<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
     /**
     * Validation messages
     *
     * @var array
     */
        protected $pesan = [
        'name.required' => 'Isikan Nama Anda',
        'name.string' => 'Nama harus berupa teks',
        'name.max' => 'Nama maksimal 255 karakter',
        'email.required' => 'Isikan Email Anda',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah digunakan',
        'users_email.email' => 'Format email tidak valid',
        'password.min' => 'Password minimal 8 karakter',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    protected $aturan = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'users_email' => ['nullable', 'email', 'max:255'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ];

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('admin.profil.index', [
            'name' => $user->name,
            'email' => $user->email,
            'users_email' => $user->users_email ?? '',
            'success' => '0'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        // Get current user
        $user = Auth::user();
        
        // Dynamic validation - email unique kecuali untuk user saat ini
        $rules = $this->aturan;
        $rules['email'][] = 'unique:users,email,' . $user->id;

        // Validate request
        $validated = $request->validate($rules, $this->pesan);
        
        // Find user model
        $userModel = User::findOrFail($user->id);
        
        // Update user data
        $userModel->name = $validated['name'];
        $userModel->email = $validated['email'];
        $userModel->users_email = $validated['users_email'] ?? null;
        
        // Update password only if provided
        if (!empty($validated['password'])) {
            $userModel->password = Hash::make($validated['password']);
        }

        $userModel->save();
        
        Alert::success('Profil berhasil diubah', 'Success');
        
        return redirect()->route('admin.profil.index');
    }
}
