<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $bookingsQuery = $user->bookings()->with('product');

        if ($request->filled('payment_status') && in_array($request->payment_status, ['0', '1'])) {
            $bookingsQuery->where('payment_status', $request->payment_status);
        }

        return view('profile.index', [
            'user' => $user,
            'bookings' => $bookingsQuery->get()
        ]);
    }


    /**
     * @return View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $data =  $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:20',
        ]);

        auth()->user()->update($data);

        return redirect()->back()->with('success', 'Профиль успешно обновлён.');
    }


    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('profile.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('profile.index');
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль',
        ])->onlyInput('email');
    }

    /**
     * @return View
     */
    public function showRegisterForm(): View
    {
        return view('profile.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'surname' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'name.regex' => 'Имя не должно содержать цифры',
            'surname.regex' => 'Фамилия не должна содержать цифры',
            'email.email'  => 'Email должен содержать "@"',
            'password.min' => 'Пароль должен быть не менее 8 символов',
        ]);

        $user = User::query()->create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('profile.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('site.index');
    }
}
