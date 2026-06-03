@extends('layouts.app')

@section('title', 'Author Login')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-c p-4">
                    <h1 class="h4 mb-3" style="color: #1976d2; font-weight: bold;">Author Login</h1>

                    @if (session()->has('message'))
                        <div class="alert alert-info">{{ session()->get('message') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('author.login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" id="password" type="password" name="password" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        New author?
                        <a href="{{ route('author.register') }}">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
