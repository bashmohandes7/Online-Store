<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ProfileInterface;
use App\Http\Requests\Dashboard\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileInterface $profileInterface;

    public function __construct(ProfileInterface $profileInterface)
    {
        $this->profileInterface = $profileInterface;
    }

    public function edit()
    {
        return $this->profileInterface->edit();
    } // end of edit

    public function update(ProfileRequest $request)
    {
        return $this->profileInterface->update($request);
    } // end of update
}
