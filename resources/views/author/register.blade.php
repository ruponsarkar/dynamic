@extends('layouts.app')

@section('title', 'Author Register')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card-c p-4">
                    <h1 class="h4 mb-3" style="color: #1976d2; font-weight: bold;">Author Registration</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('author.register.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mobile">Mobile</label>
                            <input class="form-control" id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="affiliation">Affiliation</label>
                            <textarea class="form-control" id="affiliation" name="affiliation" rows="3" required>{{ old('affiliation') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Register</button>
                    </form>

                    <div class="text-center mt-3">
                        Already registered?
                        <a href="{{ route('author.login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
