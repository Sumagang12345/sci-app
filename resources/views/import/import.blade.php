@extends('layouts.app')
@section('page-title', $title)
@prepend('page-css')
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">
@endprepend
@section('content')
<div class="container-fluid">
    @if(Session::has('success'))
        <div class='alert alert-success'>
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <h3 class='text-dark'>Import & Export</h3>
                    <hr>
                    <form class="md-form mb-2" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <p class='text-dark mb-1'>Attach an <strong>Excel</strong> file</p>
                            <input class="form-control" name="file" type="file" id="file">
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary text-uppercase shadow" name="import">
                                <span class="fas fa-paper-plane mr-2"></span>
                                Import Data
                            </button>
                        </div>
                        <div class="cleafix"></div>
                    </form>

                    <div class="clearfix"></div>

                    <hr>

                    <div class="float-right">
                        <button type="button" class="btn btn-success shadow" id="export">
                            <i class='fas fa-file mr-2'></i>
                            EXPORT DATA
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('page-scripts')
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script>
    $('.datepicker').datepicker({
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });

    document.getElementById("export").addEventListener("click", function () {
        window.location = "export";
    });
</script>
@endpush
@endsection
