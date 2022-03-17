@extends('layouts.admin-layout')

@section('title')
    ABC School | Dashboard-Profile
@endsection

@section('manage-profile')
    menu-open active
@endsection

@section('view-profile')
    active
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Profile</h1>
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
                                   Edit Profile
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('profile.view') }}"> <i
                                                    class="fa fa-list"></i>Go Back</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('profile.update', $editData->id) }}" method="POST" role="form" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    {{-- @method('put') --}}
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="name">Name</label>
                                            <input id="name" class="form-control" type="text" name="name" value="{{ $editData->name }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">E-mail</label>
                                            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $editData->email }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mobile">Mobile No</label>
                                            <input id="mobile" class="form-control" type="text" name="mobile" value="{{ $editData->mobile }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address">Address</label>
                                            <input id="address" class="form-control" type="text" name="address" value="{{ $editData->address }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender">Gender</label>
                                            <select id="gender" class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male" {{ $editData->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $editData->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Others" {{ $editData->gender == 'Others' ? 'selected' : '' }}>Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="image">Image</label>
                                            <input id="image" class="form-control" type="file" name="image">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/profile_images/'.$editData->image) : url('upload/avater_1.png') }}" style="width: 150px; height:160px; border:1px solid #666;" alt="">
                                        </div>

                                        {{-- <div class="form-group col-md-4">
                                            <label for="password">Password</label>
                                            <input id="password" class="form-control" type="password" name="password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password2">Confirm Password</label>
                                            <input id="password2" class="form-control" type="password" name="password2">
                                        </div> --}}
                                        <div class="form-group col-md-6" style="padding-top: 50px">
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
                    address: {
                        required: true,
                    },
                    mobile: {
                        required: true,
                    },
                    gender: {
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
                    address: {
                        required: "Please enter your address!",
                    },
                    mobile: {
                        required: "Please enter mobile number!",
                    },
                    gender: {
                        required: "Please select gender!",
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
