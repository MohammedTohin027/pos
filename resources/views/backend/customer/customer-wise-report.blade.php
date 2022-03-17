@extends('layouts.admin-layout')

@section('title')
    ABC School | Customer Wise Report
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Customer Wise Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight:bold">
                                    Select Criteria
                                </h3>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <strong>Credit customer report</strong>
                                        <input type="radio" name="customer_wise_report" value="customer_wise_credit"
                                            class="search_value"> &nbsp;&nbsp;
                                        <strong>Paid customer report</strong>
                                        <input type="radio" name="customer_wise_report" value="customer_wise_paid"
                                            class="search_value">
                                    </div>
                                </div>
                                <div class="show_credit" style="display: none">
                                    <form action="{{ route('customer.wise.credit.report') }}" method="get"
                                        id="creditCustomerWiseReport">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Customer Name</label>
                                                <select name="customer_id" id="customer_i" class="form-control select2"
                                                    style="width: 100%;">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->mobile }} - {{ $item->address }})</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-4" style="padding-top: 30px">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                        class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="show_paid" style="display: none">
                                    <form action="{{ route('customer.wise.paid.report') }}" method="get"
                                        id="paidCustomerWiseReport">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="form-control select2"
                                                    style="width: 100%;">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->mobile }} - {{ $item->address }})</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-4" style="padding-top: 30px">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                        class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'customer_wise_credit') {
                $('.show_credit').show();
            } else {
                $('.show_credit').hide();
            }

            if (search_value == 'customer_wise_paid') {
                $('.show_paid').show();
            } else {
                $('.show_paid').hide();
            }
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#paidCustomerWiseReport').validate({
                ignore: [],
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "customer_id") {
                        error.insertAfter(element.next());
                    }
                    else {
                        error.insertAfter(element);
                    }
                },
                errorClass: 'text-danger',
                validClass: 'text-success',
                rules: {
                    customer_id: {
                        required: true,
                    },
                },
                messages: {

                },
            });
            $('#creditCustomerWiseReport').validate({
                ignore: [],
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "customer_id") {
                        error.insertAfter(element.next());
                    }
                    else {
                        error.insertAfter(element);
                    }
                },
                errorClass: 'text-danger',
                validClass: 'text-success',
                rules: {
                    customer_id: {
                        required: true,
                    },
                },
                messages: {

                },
            });
        });
    </script>

@endsection
