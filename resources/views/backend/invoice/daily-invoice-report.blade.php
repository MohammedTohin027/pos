@extends('layouts.admin-layout')

@section('title')
    ABC School | Invoice Report
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Invoice Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice Report</li>
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
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('invoice.daily.report.pdf') }}" method="get" id="myForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Start Date</label>
                                            <input type="date" name="start_date" id="start_date"
                                                class="form-control form-control-sm datepicker">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>End Date</label>
                                            <input type="date" name="end_date" id="end_date"
                                                class="form-control form-control-sm datepicker">
                                        </div>

                                        <div class="form-group col-md-2" style="padding-top: 30px;">
                                            <button class="btn btn-sm btn-success"> <i class="fa fa-search"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                </form>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    end_date: {
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

    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
