<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    $user->name = $request->input('name');
    $user->first_name = $request->input('first_name');
    $user->email = $request->input('email');

    // Réinitialiser la vérification si l'email a changé
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Gérer la photo de profil
    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }
        $path = $request->file('profile_photo')->store('profile-photos', 'public');
        $user->profile_photo = $path;
    }

    // Mettre à jour le mot de passe si présent
    if ($request->filled('password')) {
        $user->password = $request->input('password');
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
