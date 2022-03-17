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
                    <section class="col-md-4 offset-md-4 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                              <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ (!empty($user->image)) ? url('upload/profile_images/'.$user->image) : url('upload/avater_1.png') }}"
                                     alt="User profile picture" style="width: 120px; height: 120px; border-redius: 50%">
                              </div>

                              <h3 class="profile-username text-center">{{ $user->name }}</h3>
                              <p class="text-muted text-center">{{ $user->address }}</p>

                              <table width="100%" class="table table-bordered">
                                  <tbody>
                                      <tr>
                                          <td>Mobile No</td>
                                          <td>{{ $user->mobile }}</td>
                                      </tr>
                                      <tr>
                                        <td>E-mail</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                      <tr>
                                          <td>Gender</td>
                                          <td>{{ $user->gender }}</td>
                                      </tr>
                                  </tbody>
                              </table>

                              <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block mt-2"><b>Edit Profile</b></a>
                            </div>
                            <!-- /.card-body -->
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
@endsection
