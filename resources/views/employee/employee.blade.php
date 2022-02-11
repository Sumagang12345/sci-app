@extends('layouts.app')
@section('page-title', $title)
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __($title) }}</div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                            One of three columns
                            </div>
                            <div class="col-sm">
                            One of three columns
                            </div>
                            <div class="col-sm">
                            One of three columns
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
