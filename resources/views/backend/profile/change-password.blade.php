@extends('layouts.admin-layout')

@section('title')
    ABC School | Profile-Change-Password
@endsection

@section('manage-profile')
    menu-open active
@endsection

@section('change-password')
    active
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Password</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                    <section class="col-md-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight:bold">
                                   Edit Password
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('profile.view') }}"> <i
                                                    class="fa fa-list"></i>View Profile</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('update.password') }}" method="POST" role="form" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="current_password">Current Password</label>
                                            <input id="current_password" class="form-control" type="password" name="current_password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password">New Password</label>
                                            <input id="password" class="form-control" type="password" name="password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password2">Confirm Password</label>
                                            <input id="password2" class="form-control" type="password" name="password2">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input type="submit" class="btn btn-primary" value="Update">
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
                    current_password: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password2: {
                        required: true,
                        equalTo: '#password'
                    },
                },
                messages: {
                    current_password: {
                        required: "Please enter current password!",
                    },
                    password: {
                        required: "Please new enter password",
                        minlength: "Password will be minimum 8 characters or numbers"
                    },
                    password2: {
                        required: "Please enter confirm password",
                        minlength: "Confirm password dees not match!"
                    },

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
