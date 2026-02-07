<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderByDesc('id')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::query()->orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['0', '1', '2', 0, 1, 2])],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'],
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'token' => Str::random(60),
            'status' => $validated['status'] ?? 0,
        ]);

        $roles = Role::query()->whereIn('id', $validated['roles'])->get();
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::query()->orderBy('name')->get();
        $userRoleIds = $user->roles()->pluck('id')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRoleIds'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['0', '1', '2', 0, 1, 2])],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'status' => $validated['status'] ?? $user->status,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        $user->update($data);

        $roles = Role::query()->whereIn('id', $validated['roles'])->get();
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
