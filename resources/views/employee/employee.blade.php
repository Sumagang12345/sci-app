@extends('layouts.app')
@section('page-title', $title)
@section('content')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="empData" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class='text-dark'>{{  $title }}</h2>
                </div>
                <div class="col-12 pt-2 pr-3">
                    <button id="addNew" class="show-details btn btn-primary shadow float-right ">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="p-3">
                    <table style="width:100%" class="table table-hover table-bordered" id="list-of-employee">
                        <thead>
                            <tr>
                                <th class='lead text-uppercase w-25'>Fullname</th>
                                <th class='lead text-uppercase'>Amount</th>
                                <th class='lead text-uppercase' width="10%">Option</th>
                            </tr>
                        </thead>
                        <tbody class='text-dark'>
                        </tbody>
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
                <div class="card-header">
                    <h2 class='text-dark'>
                        Add {{ __($title) }}
                    </h2>
                </div>

                <div class="row p-3">
                    <div class="col-12 mt-2">
                        <button id="showData" class="show-details btn btn-warning text-white shadow-sm float-right ">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class='text-dark'>Enter fullname</label>
                            <input type="text" id="fullname" class="form-control" placeholder="Input Fullname">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class='text-dark'>Enter Amount</label>
                            <input type="number" id="amount" class="form-control" placeholder="Input Amount">
                        </div>
                        <button id="create" class="show-details btn btn-success shadow float-right">
                            <i class="fas fa-check mr-2"></i>
                            SAVE
                        </button>
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
    $(document).ready(function () {

        let table = $("#list-of-employee").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            retrieve: true,
            language: {
                processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span> ',
            },
            ajax: "/listOfEmployee",
            createdRow: function (row, data, dataIndex) {
                $(row).find('td:eq(0)')
                    .addClass('lead');
                $(row).find('td:eq(1)')
                    .attr('contenteditable', true)
                    .attr('id', `amount${data.id}`)
                    .addClass('lead');
            },
            columns: [{
                    class: 'align-middle ',
                    data: "FullName",
                    name: "FullName",
                },
                {
                    class: 'align-middle text-center',
                    data: "Amount",
                    name: "Amount",
                },
                {
                    class: 'align-middle text-center',
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    orderable: false,
                    render: function (_, _, data, row) {
                        return `
                            <button data-row-id="${data['id']}" class="show-details btn btn-success shadow btn-update-record">
                                <i class="fas fa-check"></i>
                            </button>
                            <button data-row-id="${data['id']}" id="delete" class="show-details btn btn-danger shadow btn-delete-record">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    },
                },
            ],
        });

        let swalCustomMessage = (text) => {
            let messageContent = document.createElement('p');
            messageContent.classList.add('text-dark')
            messageContent.innerHTML = `<center> <br> ${text} </center>`;
            swal({
                content: messageContent,
                icon: 'success',
                timer: 5000,
                buttons: false,
            });
        };



        $(document).on('click', '.btn-update-record', function () {
            let rowID = $(this).attr('data-row-id');
            let amount = document.getElementById(`amount${rowID}`).textContent;

            $.ajax({
                url: `/update/${rowID}`,
                method: 'POST',
                data: {
                    amount
                },
                success: function (response) {
                    if (response.success) {
                        swalCustomMessage('Successfully Saved!')
                    }
                }
            });
        });

        $(document).on('click', '.btn-delete-record', function () {
            let rowID = $(this).attr('data-row-id');
            swal({
                title: "Wait a minute",
                text: "Are you sure you want to delete this record?",
                icon: 'warning',
                dangerMode: true,
            }).then((isClicked) => {
                if (isClicked) {
                    $.ajax({
                        url: `/delete/${rowID}`,
                        method: 'POST',
                        success: function (response) {
                            if (response.success) {
                                swalCustomMessage('Succesfully deleted');
                                table.ajax.reload();
                            }
                        }
                    });
                }
            });
        });



        $("#addNew").click(function () {
            $("#addEmp").attr("class", "container-fluid ");
            $("#empData").attr("class", "container-fluid d-none");
        });

        $("#showData").click(function () {
            $("#addEmp").attr("class", "container-fluid d-none");
            $("#empData").attr("class", "container-fluid");
        });

        $("#create").click(function () {
            let fullname = $("#fullname").val();
            let amount = $("#amount").val();
            if (fullname == '' && amount == '') {
                let ol = document.createElement('ol');
                ol.innerHTML = '<li class="text-danger">Fullname is required</li>';
                ol.innerHTML += '<li class="text-danger">Amount is required</li>';
                swal({
                    content : ol,
                    icon : 'error',
                    timer : 5000,
                    buttons : false,
                });
            } else if (fullname == '') {
                let ol = document.createElement('ol');
                ol.innerHTML = '<li class="text-danger">Fullname is required</li>';
                swal({
                    content : ol,
                    icon : 'error',
                    timer : 5000,
                    buttons : false,
                });
            } else if (amount == '') {
                let ol = document.createElement('ol');
                ol.innerHTML += '<li class="text-danger">Amount is required</li>';
                swal({
                    content : ol,
                    icon : 'error',
                    timer : 5000,
                    buttons : false,
                });
            } else {
                $.ajax({
                    url: '/create',
                    method: 'POST',
                    data: {
                        fullname: fullname,
                        amount: amount
                    },
                    success: function (response) {
                        if (response.success) {
                            swalCustomMessage('Successfully Saved!')
                            document.getElementById('fullname').value = '';
                            document.getElementById('amount').value = '';
                        }
                    },
                });
            }
        });

    });
    //let amount = '1,000';
    //if(amount == ''){
    //    swal('Amount field is required', '', 'error');
    //}else if((amount.includes(",") == true) || (amount.includes(".") == true) || (amount.includes("1") == true) || (amount.includes//("2") == true) || (amount.includes("3") == true) || (amount.includes("4") == true) || (amount.includes("5") == true) || //(amount.includes("6") == true) || (amount.includes("7") == true) || (amount.includes("8") == true) || (amount.includes("9") == //true) || (amount.includes("0") == true)){
    //
    //    let result = ;
    //    swal('Amount field is not a Number', '', 'error');
    //}else{
    //    swal('gooo', '', 'error');
    //}

</script>
@endpush
@endsection
