<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, AuthService $auth): RedirectResponse
    {
        $auth->login($request);

        return redirect('home');
    }

    public function destroy(Request $request, AuthService $auth): RedirectResponse
    {
        $auth->logout($request);

        return redirect('admin.login.form');
    }
}
