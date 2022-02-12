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
                        <form action="{{ route('import.add') }}" method="POST" enctype="multipart/form-data">
                        @CSRF
                            <input type="file" name="file">
                            <input type="submit" name="import" value="import">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                                                                                                                                                                                                                                    