@extends('layouts.admin-layout')

@section('title')
    ABC School | Purchase
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Purchase</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Purchase</li>
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
                                    Purchase List
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('purchase.create') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Add New</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-responsive table-sm table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Purchase No</th>
                                            <th>Date</th>
                                            <th>Supplier Name</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th width="8%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->purchase_no }}</td>
                                                <td>{{ date('d-M Y', strtotime($item->date)) }}</td>
                                                <td>{{ $item->supplier->name }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->discription }}</td>
                                                <td>
                                                    {{ $item->buying_qty }}
                                                    {{ $item->product->unit->name }}</td>
                                                <td>{{ $item->unit_price ." .tk" }}</td>
                                                <td>{{ $item->buying_price ." .tk" }}</td>
                                                <td>
                                                    @if($item->status == 0)
                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                    @else
                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 0)
                                                    <a href="{{ route('purchase.delete', $item->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                                    @else

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
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
@endsection
