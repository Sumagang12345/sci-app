@extends('layouts.app')
@section('page-title', $title)
@section('content')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="empData" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __($title) }}</div>

                <div class="col-12 pt-2 pr-3">
                    <button id="addNew" class="show-details btn btn-primary rounded-pill float-right ">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button id="" class="show-details btn btn-danger rounded-pill float-right mr-2">
                        <i class="fas fa-trash"></i>
                    </button>
            </div>
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

    <div id="addEmp" class="container-fluid d-none">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add {{ __($title) }}</div>
                    <div class="col-12 pt-2">
                        <button id="showData" class="show-details btn btn-success rounded-pill float-right ">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                        <div class="row p-3">
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Input Emp ID"></input>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" placeholder="Input Fullname"></input>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" placeholder="Input Amount"></input>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</div>
@push('page-scripts')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
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
            render : function (_, _, data, row) {
                    return `
                        <b><span contenteditable="true" id="amount${data['id']}">${data['Amount']}</span></b>
                    `;
            },
        },
        {
                class : 'align-middle text-center',
                data : 'actions',
                name : 'actions',
                searchable: false,
                orderable: false,
                render : function (_, _, data, row) {
                        return `
                            <button data-row="" class="show-details btn btn-success rounded-pill" onclick="$(function () {var amount = document.getElementById('amount${data['id']}').innerHTML; $.ajax({ url: '/update/${data['id']}', method: 'POST', data: { amount: amount }, success: function (response) {}, }); });">
                                <i class="fas fa-check"></i>
                            </button>
                        `;
                },
        },
    ],
});

$("#addNew").click(function () {
        $("#addEmp").attr("class", "container-fluid ");
        $("#empData").attr("class", "container-fluid d-none");
    });

    $("#showData").click(function () {
        $("#addEmp").attr("class", "container-fluid d-none");
        $("#empData").attr("class", "container-fluid");
    });

});
</script>
@endpush
@endsection
