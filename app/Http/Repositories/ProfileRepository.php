<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProfileInterface;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Countries;

class ProfileRepository implements ProfileInterface
{
    public function edit()
    {
        $user = auth()->user();
        $locales = Languages::getNames();
        $countries = Countries::getNames();
        return view('dashboard.profile.edit', compact('locales', 'countries', 'user'));
    } // end of edit
    public function update($request)
    {
        $user = $request->user();

        $user->profile->fill($request->all())->save();
        session()->flash('success', 'Profile updated');
        return to_route('profile.edit');
    } // end of update
}
