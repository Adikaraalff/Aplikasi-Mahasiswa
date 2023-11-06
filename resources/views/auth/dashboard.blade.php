@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <h2>Welcome, {{ Auth::user()->name }}</h2>
                    <p>Your Dashboard Content Goes Here</p>

                    <!-- Example: Display user information -->
                    <div class="profile-info">
                        @if(Auth::user()->profile_picture != "")
                        <img src="{{ Auth::user()->profile_picture }}" alt="Profile Picture" class="img-thumbnail">
                        @else
                        <img src="{{asset('image/user.png') }}" alt="Profile Picture" class="img-thumbnail" width="100px">
                        @endif
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection