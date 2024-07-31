@extends('layouts.header')

@section('main')

<section class="dash-content">
        <form action="{{ route('account.update.settings') }}" id = "form-data" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="preview">Profile Preview: </label>
                @if(Auth::user()->profile != "")
                    <img src="{{ asset('uploads/' .Auth::user()->profile) }}" id="previewImg" alt="Profile pic" width="100px" height="100px">
                @else 
                    <img src="https://placehold.co/990x720?text=No Image" id="previewImg" alt="Profile pic" width="100px" height="100px" >
                @endif
            </div>
            <div>
                <label for="fname">First Name:</label>
                <input type="text" name="firstName" id="fname" value="{{ old('firstName', $user->firstName) }}" placeholder="Enter your username">
                @error('firstName')
                    {{ $message }}
                @enderror
            </div>
            <div>
                <label for="lname">Last Name:</label>
                <input type="text" name="lastName" id="lname" value="{{ $user->lastName }}" placeholder="Enter your username">
                @error('lastName')
                    {{ $message }}
                @enderror
            </div>
            <div>
                <label for="email">email:</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}" placeholder="Enter your username">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div>
                <label for="profile">Profile:</label>
                <input type='file' name='profile' accept="image/*" id='profile'>
                @error('profile')
                    {{ $message }}
                @enderror
            </div>
            <div>
                <label for="user">User Name:</label>
                <input type="text" name="username" id="user" value="{{ $user->username }}" placeholder="Enter your username">
                @error('username')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-btn">
                <input type="reset" value="Reset">
                <input type="submit" value="Submit" name="submit">
            </div>
        </form>
</section>

@endsection