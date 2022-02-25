@extends('layouts.app')
@section('page-title', $title)
@prepend('page-css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">
@endprepend
@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li class='mx-2'>{{ $error }}</li>
        @endforeach
    </div>
@elseif(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
<div class="card">
    <div class="card-header">
        <h5 class='text-dark'>{{ $title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('account.setting.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Fullname</label>
                <input type="text" class='form-control {{ $errors->has('fullname') ? 'is-invalid border-danger' : '' }}' value="{{ old('fullname') ?? $user->name }}" name="fullname">
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" class='form-control {{ $errors->has('username') ? 'is-invalid border-danger' : '' }}' value="{{ old('username') ?? $user->username }}" name="username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" class='form-control {{ $errors->has('password') ? 'is-invalid border-danger' : '' }}' name="password" >
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="text" class='form-control {{ $errors->has('password') ? 'is-invalid border-danger' : '' }}' name="password_confirmation">
            </div>

            <div class="float-right">
                <button class='btn btn-success shadow text-uppercase'>
                <i class='fas fa-check mr-2'></i>  Update
                </button>
            </div>
            
        
        </form>
    </div>

</div>

@endsection
