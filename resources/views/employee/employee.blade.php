@extends('layouts.app')
@section('page-title', $title)
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __($title) }}</div>
                    <div class="container pt-2">
                            <table style="width:100%" class="table table-striped table-bordered dt-responsive nowrap" id="list-of-employee">
                            <thead>
                                <tr>
                                <th>Employee ID</th>
                                <th>Fullname</th>
                                <th>Amount</th>
                                <th>Option</th>
                                </tr>
                            </thead>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
<script>
$(document).ready(function() {
    $("#list-of-employee").DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    retrieve: true,
    language: {
        processing:
            '<i class="spinner-border"></i><span class="sr-only">Loading...</span> ',
    },
    ajax: "/listOfEmployee",
    columns: [
        {
            class : 'align-middle text-center',
            data: "EmployeeID",
            name: "EmployeeID",
        },
        {
            class : 'align-middle text-center',
            data: "FullName",
            name: "FullName",
        },
        {
            class : 'align-middle text-center',
            data: "Amount",
            name: "Amount",
        },
        {
                class : 'align-middle text-center',
                data : 'actions',
                name : 'actions',
                searchable: false,
                orderable: false,
                render : function (_, _, data, row) {
                        return `
                            <button data-row="" class="show-details btn btn-success rounded-pill">
                                <i class="fas fa-check"></i>
                            </button>
                        `;
                },
        },
    ],
});
});
</script>
@endpush
@endsection
