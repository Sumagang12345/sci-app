@extends('layouts.app')
@section('page-title', $title)
@prepend('page-css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    .w-15 {
        width: 15%;
    }

</style>
<style>
    .fab-container {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        user-select: none;
        position: absolute;
        bottom: 30px;
        right: 30px;
    }

    .fab-container:hover {
        height: 100%;
    }

    .fab-container:hover .sub-button:nth-child(2) {
        transform: translateY(-80px);
    }

    .fab-container:hover .sub-button:nth-child(3) {
        transform: translateY(-140px);
    }

    .fab-container:hover .sub-button:nth-child(4) {
        transform: translateY(-200px);
    }

    .fab-container:hover .sub-button:nth-child(5) {
        transform: translateY(-260px);
    }

    .fab-container:hover .sub-button:nth-child(6) {
        transform: translateY(-320px);
    }

    .fab-container .fab {
        position: relative;
        height: 70px;
        width: 70px;
        background-color: #4ba2ff;
        border-radius: 50%;
        z-index: 2;
    }

    .fab-container .fab::before {
        content: " ";
        position: absolute;
        bottom: 0;
        right: 0;
        height: 35px;
        width: 35px;
        background-color: inherit;
        border-radius: 0 0 10px 0;
        z-index: -1;
    }

    .fab-container .fab .fab-content {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
        border-radius: 50%;
    }

    .fab-container .fab .fab-content .material-icons {
        color: white;
        font-size: 48px;
    }

    .fab-container .sub-button {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        bottom: 10px;
        right: 10px;
        height: 50px;
        width: 50px;
        background-color: #4ba2ff;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .fab-container .sub-button:hover {
        cursor: pointer;
    }

    .fab-container .sub-button .material-icons {
        color: white;
        padding-top: 6px;
    }

</style>
@endprepend
@section('content')

<div class="p-1">
    <div class="alert alert-primary" role="alert">
        All records display in this page is posted on (DATE)
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class='text-dark text-uppercase'>Post Data</h3>
    </div>
    <div class="card-body">
        <form method="POST" id="formSendData">
            <table class='table table-bordered table-hover' id='employees-table' width="100%;">
                <thead>
                    <tr>
                        <th class='lead'>EMPLOYEE ID</th>
                        <td class='lead'>FULLNAME</td>
                        <th class='lead'>AMOUNT</th>
                    </tr>
                </thead>
                <tbody id="employeeRow"></tbody>
            </table>
        </form>
    </div>
</div>

<div class="fab-container position-fixed">
    <div class="fab shadow">
        <div class="fab-content">
            <span class="material-icons">help</span>
        </div>
    </div>

    <div id="btnSendData" class="sub-button btn-primary shadow" title="Post Data" data-toggle="tooltip"
        data-placement="left">
        <a>
            <span class="material-icons">send</span>
        </a>
    </div>

    <div class="sub-button shadow" id="addNewRecord" data-toggle="tooltip" data-placement="left" title="Add New Record">
        <a target="_blank">
            <span class="material-icons">person_add</span>
        </a>
    </div>
    <div class="sub-button shadow" data-toggle="tooltip" data-placement="left" title="Print all records">
        <a href="{{ route('print-employees') }}" target="_blank">
            <span class="material-icons">print</span>
        </a>
    </div>
    <div class="sub-button shadow" data-toggle="tooltip" data-placement="left" title="Export all records">
        <a href="{{ route('export') }}" target="_blank">
            <span class="material-icons">import_export</span>
        </a>
    </div>
</div>

@push('page-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip()


        let table = $("#employees-table").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: 1,
            retrieve: true,
            paging: false,
            destroy: true,
            language: {
                processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span> ',
            },
            ajax: "/listOfEmployee",
            columns: [{
                    class: 'align-middle text-center lead font-weight-medium w-15 text-center',
                    data: "EmployeeID",
                    name: "EmployeeID",
                    render: function (rawData) {
                        if (rawData) {
                            let ID = rawData.padStart(4, "0")
                            return `<input class='form-control text-center lead font-weight-medium border-0 bg-transparent' readonly value="${ID}">`;
                            return `<input type="hidden" class='form-control text-center lead font-weight-medium border-0 bg-transparent' name="ids[]" readonly value="${rawData}">`;
                        } 
                        return `<input class='form-control text-center lead font-weight-medium border-0 bg-transparent' name="ids[]"  value="${rawData}">`;
                    }
                },
                {
                    class: 'align-middle lead font-weight-medium text-dark',
                    data: "FullName",
                    name: "FullName",
                    render: function (rawData) {
                        return `<input class='form-control lead font-weight-medium border-0 bg-transparent' readonly  name='fullnames[]' value="${rawData || ''}">`;
                    },
                },
                {
                    class: 'align-middle text-center lead font-weight-medium text-dark',
                    data: "Amount",
                    name: "Amount",
                    render: function (rawData) {
                        return `<input class='form-control lead font-weight-medium text-center' type="number" name='amounts[]' value="${rawData || 0}">`;
                    }
                },
            ],
        });

        $("#addNewRecord").click(function () {
            $("html, body").animate({
                scrollTop: $(document).height()
            }, 0);
            $('#employeeRow').append(`
                <tr>
                    <td>
                        <input class='form-control text-center lead font-weight-medium ' name='ids[]' placeholder="Enter Employee ID">
                    </td>
                    <td>
                        <input class='form-control lead font-weight-medium '  name='fullnames[]' placeholder="Enter Fullname">
                    </td>
                    <td>
                       <input class='form-control lead font-weight-medium text-center' type="number" name='amounts[]' placeholder="Enter amount" value="0">
                    </td>
                </tr>
            `);
        });

         $('#btnSendData').click(function () {
            let data = $('#formSendData').serialize();

            $.ajax({
                url: '/send-data',
                method: 'POST',
                data : data,
                success: function (response) {
                    if(response.success) {
                        table.ajax.reload();
                        swal({
                            title: "Good job!",
                            text: "You successfully pust data",
                            icon: "success",
                            buttons : false,
                            timer : 1000,
                        });
                    }
                }
            });
        });
    });

   

</script>
@endpush
@endsection
