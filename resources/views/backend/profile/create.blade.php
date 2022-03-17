@extends('layouts.admin-layout')

@section('title')
    ABC School | Dashboard
@endsection

@section('manage-user')
    menu-open active
@endsection

@section('view-user')
    active
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                                    Add New User
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('user.view') }}"> <i
                                                    class="fa fa-list"></i> User List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('user.store') }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="usertype">User Role</label>
                                            <select id="usertype" class="form-control" name="usertype">
                                                <option value="">Select Role</option>
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Name</label>
                                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">E-mail</label>
                                            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password">Password</label>
                                            <input id="password" class="form-control" type="password" name="password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password2">Confirm Password</label>
                                            <input id="password2" class="form-control" type="password" name="password2">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="submit" class="btn btn-primary" value="Submit">
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
                    usertype: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
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
                    usertype: {
                        required: "Please select user role!",
                    },
                    name: {
                        required: "Please enter your!",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a <em>valid</em> email address"
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Password will be minimum 6 characters or numbers"
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
