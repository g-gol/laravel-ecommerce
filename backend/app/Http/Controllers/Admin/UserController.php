<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function update(AdminUserUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

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

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            abort(403, 'Cannot delete yourself');
        }

        $user->delete();

        return redirect()->back();
    }
}
