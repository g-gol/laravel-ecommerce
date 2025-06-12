<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->latest()->with(['roles'])->paginate(10)->withQueryString();
        return view('users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = Role::toArray();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'max:100', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'max:100', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'verify' => ['nullable'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', 'string', 'exists:roles,name'],
            'password' => ['nullable', Rules\Password::defaults()]
        ]);

        $user->updateOrFail([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'] ?? $user->password
        ]);

        $user->syncRoles($validated['roles']);

        if (!empty($validated['verify'])) {
            if ($user->hasVerifiedEmail()) {
                abort(403);
            }

            $user->markEmailAsVerified();
        }


        return redirect()->back();
    }
}
