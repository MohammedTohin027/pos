@extends('layouts.admin-layout')

@section('title')
    ABC School | Credit Customer
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Credit Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Credit Customer</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight:bold">
                                    Edit Credit Customer Invoice <span style="background-color: rgb(204, 203, 203)">(Invoice
                                        No #{{ $payment->invoice->invoice_no }})</span>
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('customer.credit') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-list"></i> Credit Customer List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="{{ route('customer.credit.invoice.update', $payment->invoice_id) }}" method="post" id="myForm">
                                                @csrf
                                                <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                                                <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                        <label for="">Paid Status</label>
                                                        <select class="form-control form-control-sm" name="paid_status" id="paid_status">
                                                            <option value="">Select Status</option>
                                                            <option value="full_paid">Full Paid</option>
                                                            <option value="partical_paid">Partical Paid</option>
                                                        </select>
                                                        <input class="form-control form-control-sm paid_amount" type="number" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label>Date</label>
                                                        <input type="date" name="date" id="date"
                                                            class="form-control form-control-sm datepicker">
                                                    </div>
                                                    <div class="form-group col-md-2" style="padding-top: 30px;">
                                                        <button class="btn btn-sm btn-success">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped table-hover table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="text-align: center; font-size: 18px; font-weight:700;">
                                                            <u>Customer
                                                                Information</u>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Name: </strong></td>
                                                        <td width="35%">{{ $payment->customer->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Mobile: </strong></td>
                                                        <td width="35%">{{ $payment->customer->mobile }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Address: </strong></td>
                                                        <td width="35%">{{ $payment->customer->address }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="col-md-6 m-auto">
                                    <table class="table table-bordered table-striped table-hover table-sm">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"
                                                    style="text-align: center; font-size: 18px; font-weight:700;">
                                                    <u>Customer
                                                        Information</u>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="15%"><strong>Name: </strong></td>
                                                <td width="35%">{{ $payment->customer->name }}</td>
                                            </tr>
                                            <tr>
                                                <td width="15%"><strong>Mobile: </strong></td>
                                                <td width="35%">{{ $payment->customer->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td width="15%"><strong>Address: </strong></td>
                                                <td width="35%">{{ $payment->customer->address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> --}}
                                <div class="col-md-12 m-auto">
                                    <table class="table table-bordered table-striped table-hover table-sm text-center">
                                        <thead>
                                            <th>Sl.</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $invoice_deatails = App\Models\InvoiceDetails::where('invoice_id', $payment->invoice_id)
                                                    ->orderBy('category_id', 'asc')
                                                    ->get();
                                            @endphp
                                            @php
                                                $total_sum = 0;
                                            @endphp
                                            @foreach ($invoice_deatails as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->selling_qty }}</td>
                                                    <td>{{ $item->unit_price }}</td>
                                                    <td>{{ $item->selling_price }}</td>
                                                </tr>
                                                @php
                                                    $total_sum += $item->selling_price;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="5" class="text-right"><strong>Sub Total : </strong></td>
                                                <td class="text-center"><strong>{{ $total_sum }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Discount : </td>
                                                <td class="text-center">
                                                    <strong>{{ $payment->discount_amount }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Paid Amount : </td>
                                                <td class="text-center"><strong>{{ $payment->paid_amount }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Due Amount : </td>
                                                <td class="text-center"><strong>{{ $payment->due_amount }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right"><strong>Grand Total : </strong></td>
                                                <td class="text-center"><strong>{{ $payment->total_amount }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- <form action="{{ route('customer.credit.invoice.update', $payment->invoice_id) }}" method="post" id="myForm">
                                        @csrf
                                        <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="">Paid Status</label>
                                                <select class="form-control form-control-sm" name="paid_status" id="paid_status">
                                                    <option value="">Select Status</option>
                                                    <option value="full_paid">Full Paid</option>
                                                    <option value="partical_paid">Partical Paid</option>
                                                </select>
                                                <input class="form-control form-control-sm paid_amount" type="number" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Date</label>
                                                <input type="date" name="date" id="date"
                                                    class="form-control form-control-sm datepicker">
                                            </div>
                                            <div class="form-group col-md-2" style="padding-top: 30px;">
                                                <button class="btn btn-sm btn-success">Invoice Update</button>
                                            </div>
                                        </div>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        $(document).on('change', '#paid_status', function() {
            var paid_status = $(this).val();
            // alert(paid_status);
            if (paid_status == 'partical_paid') {
                $('#paid_amount').show();
            } else {
                $('#paid_amount').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    paid_status: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
