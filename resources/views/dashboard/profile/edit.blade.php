@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

    <x-alert type="success" />

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="col-md-6">
                <label for="">First Name</label>
                <x-form.input name="first_name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <label for="">Last Name</label>

                <x-form.input name="last_name" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label for="">Birthday</label>

                <x-form.input name="birthday" type="date" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <label for="">Gender</label>

                <x-form.radio name="gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <label for="">Address</label>

                <x-form.input name="address" label="Address" :value="$user->profile->street_address" />
            </div>
            <div class="col-md-4">
                <label for="">City</label>

                <x-form.input name="city" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <label for="">State</label>

                <x-form.input name="state" :value="$user->profile->state" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <label for="">Postal Code</label>

                <x-form.input name="postal_code" :value="$user->profile->postal_code" />
            </div>
            <div class="col-md-4">
                <label for="">Country</label>

                <x-form.select_profile name="country" :options="$countries" :selected="$user->profile->country" />
            </div>
            <div class="col-md-4">
                <label for="">Locale</label>

                <x-form.select_profile name="locale" :options="$locales" :selected="$user->profile->locale" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
