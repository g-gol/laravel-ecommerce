<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisteredUserController extends Controller
{
    public function store(Request $request, AuthService $auth): Response
    {
        $auth->register($request)->assignRole(Role::CUSTOMER->value);

        return response()->noContent();
    }
}
