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
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight:bold">
                                    Credit Customer List
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('customer.credit.pdf') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-download"></i> Download PDF</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Customer Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_sum = 0;
                                        @endphp
                                        @foreach ($allData as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $item->customer->name }}
                                                    ({{ $item->customer->mobile }} - {{ $item->customer->address }})
                                                </td>
                                                <td>Invoice No #{{ $item['invoice']['invoice_no'] }}</td>
                                                <td>{{ date('d-M-Y', strtotime($item['invoice']['date'])) }}</td>
                                                <td>{{ $item->due_amount }}</td>
                                                <td>
                                                    <a href="{{ route('customer.credit.invoice.edit', $item->invoice_id) }}" class="btn btn-primary btn-sm" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="{{ route('customer.credit.invoice.details.pdf', $item->invoice_id) }}" class="btn btn-success btn-sm" title="Details"><i
                                                            class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $total_sum += $item->due_amount;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-sm table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right"><strong>Grand Total : </strong></td>
                                            <td><strong>{{ $total_sum }} TK.</strong></td>
                                        </tr>
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
