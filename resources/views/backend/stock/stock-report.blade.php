@extends('layouts.admin-layout')

@section('title')
    ABC School | Product Stock Report
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Product Stock Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                                    Product List
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('stock.report.pdf') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-download"></i> Download PDF</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Supplier Name</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>In Qty</th>
                                            <th>Out Qty</th>
                                            <th>Stock</th>
                                            <th>Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                        @php
                                            $buying_total = App\Models\Purchase::where('category_id', $item->category_id)->where('product_id',$item->id)->where('status', '1')->sum('buying_qty');
                                            $selling_total = App\Models\InvoiceDetails::where('category_id', $item->category_id)->where('product_id',$item->id)->where('status', '1')->sum('selling_qty')
                                        @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->supplier->name }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $buying_total }}</td>
                                                <td>{{ $selling_total }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->unit->name }}</td>
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
