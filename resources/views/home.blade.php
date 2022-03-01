@extends('layouts.app')
@section('page-title', $title)
@prepend('meta-data')
<meta name="values" content="{{ $employees }}">
@endprepend
@prepend('page-css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">
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
<div class="card">
    <div class="card-header">
        <h5 class='text-dark'>Post Data</h3>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <p class='text-dark mb-1'>Post Month</p>
            <input type="text" name="post_date" class='datepicker form-control' id="postMonths"
                value="{{ date('m-Y') }}">
        </div>
        <form method="POST" id="formSendData">

            <table class='table table-bordered table-hover' id='' width="100%;">
                <thead>
                    <tr>
                        <th class='lead text-dark'>EMPLOYEE ID</th>
                        <td class='lead text-dark'>FULLNAME</td>
                        <th class='lead text-dark'>AMOUNT</th>
                    </tr>
                </thead>
                <tbody id="employeeRow">

                    @foreach($employees as $employee)
                    <tr>
                        <td class='text-dark'>
                            <input class='form-control lead font-weight-medium border-0 bg-transparent need-to-submit'
                                data-id="{{ $loop->index + 1 }}" data-row="{{ $loop->index + 1 }}" name='ids[]'
                                value="{{ $employee->EmployeeID }}">
                        </td>
                        <td class='text-dark'>
                            <input class='form-control lead font-weight-medium border-0 bg-transparent'
                                data-fullname="{{ $loop->index + 1 }}" data-row="{{ $loop->index + 1 }}" readonly
                                name='fullnames[]' value="{{ $employee->FullName }}">
                        </td>
                        <td class='text-dark'>
                            <input class='form-control lead font-weight-medium text-center need-to-submit'
                                data-amount="{{ $loop->index + 1 }}" data-row="{{ $loop->index + 1 }}" type="number"
                                name='amounts[]' value="{{ $employee->Amount ?? '' }}">
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.1/socket.io.min.js" integrity="sha512-iqRVtNB+t9O+epcgUTIPF+nklypcR23H1yR1NFM9kffn6/iBhZ9bTB6oKLaGMv8JE9UgjcwfBFg/eHC/VMws+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>
    $(document).ready(function () {
        let elements = [];
        const MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        let socket = io.connect('http://192.168.1.23:3030', {
            forceNew : true,
        });

        $('.datepicker').datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months"
        });


        $('[data-toggle="tooltip"]').tooltip()

        $("#addNewRecord").click(function () {
            $("html, body").animate({
                scrollTop: $(document).height()
            }, 0);

            let rowID = $('#employeeRow').children().length + 1;
            $('#employeeRow').append(`
                <tr id='row-${rowID}'>
                    <td>
                        <input class='form-control text-center lead font-weight-medium need-to-submit' data-id="${rowID}" data-row="${rowID}" name='ids[]' placeholder="Enter Employee ID">
                    </td>
                    <td>
                        <input class='form-control lead font-weight-medium need-to-submit' data-fullname="${rowID}" data-row="${rowID}" name='fullnames[]' placeholder="Enter Fullname">
                    </td>
                    <td>
                       <input class='form-control lead font-weight-medium text-center need-to-submit' data-amount="${rowID}" data-row="${rowID}" type="number" name='amounts[]' placeholder="Enter amount" value="0">
                    </td>
                    <td class='text-center'>
                        <button class='btn btn-danger remove-field shadow' data-row="${rowID}" type='button'>
                            <i class='fas fa-times'></i>
                        </button>
                    </td>
                </tr>
            `);
        });

        $(document).on('change', '.need-to-submit', function (e) {
            let id = $(this).attr('data-row');
            elements.push(id);
        });

        $(document).on('click', '.remove-field', function () {
            let ID = $(this).attr('data-row');
            $(`#row-${ID}`).remove();
        });

        let swalCustomMessage = (text, icon, others) => {
            let messageContent = document.createElement('p');
            messageContent.classList.add('text-dark')
            messageContent.innerHTML = `<center> <br> ${text} </center>`;
            return swal({
                content: messageContent,
                icon: icon,
                ...others
            });
        };

        $('#btnSendData').click(function () {
            let elemenetsIDWithChanges = [...new Set(elements)];
            let ids = [];
            let fullnames = [];
            let amounts = [];

            let dataarray = $('#formSendData').serializeArray();
            const LAST_CHARACTER = -1;
            let stringIDS = "";
            let stringFullNames = "";
            let stringAmounts = "";

            elemenetsIDWithChanges.map((id) => {
                let employeeID = $(`input[data-id=${id}]`).val();
                let fullName = $(`input[data-fullname=${id}]`).val() || '';
                let sciAmount = $(`input[data-amount=${id}]`).val() || 0;

                ids.push(employeeID);
                fullnames.push(fullName);
                amounts.push(sciAmount);
            });

            $.ajax({
                url: '/send-data',
                method: 'POST',
                data: {
                    ids,
                    fullnames,
                    amounts,
                    post_month: $('#postMonths').val(),
                },
                success: function (response) {

                }
            });

            for (let index = 0; index <= dataarray.length - 1; index++) {
                let {
                    name,
                    value
                } = dataarray[index];
                key = name.replace("[]", "", /ig/);

                if (key.includes('ids')) {
                    stringIDS += `${value}|`;
                }
                if (key.includes('fullnames')) {
                    stringFullNames += `${value}|`;
                }

                if (key.includes('amounts')) {
                    stringAmounts += `${value}|`;
                }
            }
                swalCustomMessage("Are you sure you want to post this deductions this process would need an Internet connection", "warning", { 
                    button : {
                        text : "Yes",
                        closeModal : false,
                    }
                }).then((isConfirmed) => {
                    if (isConfirmed) {
                        if (window.navigator.onLine == true) {
                            axios.post('https://surigaodelsur.ph/dts/sci-server', {
                                employeeid: stringIDS,
                                fullname: stringFullNames,
                                amount: stringAmounts,
                                postDate : $('#postMonths').val(),
                            }).then((response) => {
                                swal.close();
                                swal.stopLoading();
                                let [month, year] = $('#postMonths').val().split('-');
                                month = MONTHS[parseInt(month) - 1];
                                socket.emit('NOTIFY_SUPPORTS', { month : `${month} ${year}` } );
                                swalCustomMessage("You have successfully post the deductions", "success", {
                                    buttons : false,
                                    timer : 5000,
                                });
                            });
                        } else {
                            swalCustomMessage("Unable to post deductions please check your internet connection and try again ", "error", {
                                    buttons : false,
                                    timer : 5000,
                                });
                        }
                    }
                });

        });

    });

</script>
@endpush
@endsection
