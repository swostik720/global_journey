<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    use UploadFileTrait;
    public function index(): View
    {
        return view('admin.profiles.index', [
            'user' => auth()->user()
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['new_password', 'confirm_password', 'current_password', 'image']);

        if ($request->new_password) {
            $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);

            if (!$currentPasswordStatus) {
                return redirect()->route('admin.profiles.index')->with('error', 'Current password does not match');
            }

            $data['password'] = Hash::make($request->new_password);
        }

        if ($request->hasFile('image')) {
            auth()->user()->updateImage('image', 'profile-images', $request->file('image'));
        }

        auth()->user()->update($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile updated successfully');
    }
}
