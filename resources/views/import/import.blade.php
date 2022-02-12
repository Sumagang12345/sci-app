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
                            <div style="border-right: 1px solid #A6969D;" class="col-6">
                                <label for="formFileLg" class="pt-2 form-label">Import Data</label>
                                    <form class="md-form mb-2" action="{{ route('import.add') }}" method="POST" enctype="multipart/form-data">
                                    @CSRF
                                        <div class="file-field">
                                        <div class="btn btn-primary btn-sm float-left">
                                            <input type="file" name="file">
                                        </div>
                                        </div>
                                    </form>
                                    <br><br>
                                    <input type="submit" class="btn btn-primary" name="import" value="Import Data">
                                    <br><br>
                            </div>
                            <div class="col-6">
                                <label for="formFileLg" class="pt-2 form-label">Export Data</label><br>
                                    <button type="button" class="btn btn-success">Export Data</button><br>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                                                                                                                                                                                                                                    