<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'notification_allowed' => 'boolean',
            'telegram_user_id' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'notification_allowed' => $request->has('notification_allowed'),
            'telegram_user_id' => $request->telegram_user_id,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Користувача успішно оновлено!');
    }
}
