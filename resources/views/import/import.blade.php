@extends('layouts.app')
@section('page-title', $title)
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __($title) }}</div>
                            <div class="row align-items-center">
                                <div class="col">
                                Import
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
