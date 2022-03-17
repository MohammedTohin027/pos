@extends('layouts.admin-layout')

@section('title')
    ABC School | Invoice
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Pending Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
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
                                   Pending Invoice List
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">

                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Customer Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th width="8%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->payment->customer->name }} ({{ $item->payment->customer->mobile .' - '.$item->payment->customer->address }})</td>
                                                <td>{{ "Invoice No #" .$item->invoice_no }}</td>
                                                <td>{{ date('d-M Y', strtotime($item->date)) }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->payment->total_amount ." .tk" }}</td>
                                                <td>
                                                    @if($item->status == 0)
                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                    @else
                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('invoice.approve', $item->id) }}" class="btn btn-success btn-sm" title="Approve"><i
                                                        class="fa fa-check-circle"></i></a>
                                                    <a href="{{ route('invoice.delete', $item->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
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
