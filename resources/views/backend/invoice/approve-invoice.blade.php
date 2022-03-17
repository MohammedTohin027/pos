@extends('layouts.admin-layout')

@section('title')
    ABC School | Approve Invoice
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Invoice</h1>
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
                                    Invoice No #{{ $invoice->invoice_no }}
                                    ({{ date('d-m-Y', strtotime($invoice->date)) }})
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('invoice.pending.view') }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-list"></i> Pending Invoice List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-md-6" style="margin:0 auto;">
                                    <table class="table table-bordered table-sm table-striped" width="100%">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"
                                                    style="font-size: 22px; font-weight:700; text-align:center;">Customer
                                                    Info</td>
                                            </tr>
                                            <tr>
                                                <td width="15%">Name</td>
                                                <td width="15%">{{ $invoice->payment->customer->name }}</td>
                                            </tr>
                                            <tr>
                                                <td width="15%">Mobile</td>
                                                <td width="15%">{{ $invoice->payment->customer->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td width="15%">Address</td>
                                                <td width="15%">{{ $invoice->payment->customer->address }}</td>
                                            </tr>
                                            <tr>
                                                <td width="15%">Description</td>
                                                <td width="15%">{{ $invoice->description }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body">
                                @php
                                    $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                                @endphp
                                <form action="{{ route('approvel.store', $invoice->id) }}" method="post">
                                    @csrf
                                    <table border="1px" width="100%">
                                        <tr style="text-align: center">
                                            <th>SL.</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th style="background-color: rgba(172, 171, 171, 0.774)" width="13%">Current Stock</th>
                                            <th width="10%">Quantity</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="12%">Total Price</th>
                                        </tr>
                                        @php
                                            $total_sum = 0;
                                        @endphp
                                        @foreach ($invoice->invoice_details as $key => $item)
                                        <tr style="text-align: center">
                                            <input type="hidden" name="category_id[]" value="{{ $item->category_id }}">
                                            <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                            <input type="hidden" name="selling_qty[{{ $item->id }}]" value="{{ $item->selling_qty }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->product->name }} </td>
                                            <td style="background-color: #ddd">{{ $item->product->quantity }}</td>
                                            <td>{{ $item->selling_qty }}</td>
                                            <td>{{ $item->unit_price }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                        </tr>
                                        @php
                                            $total_sum += $item->selling_price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td style="text-align: right; font-size: 16px; font-weight:700;" colspan="6">Sub Total : </td>
                                            <td style="text-align: center"><strong>{{ $total_sum }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;" colspan="6">Discount : </td>
                                            <td style="text-align: center"><strong>{{ $payment->discount_amount }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;" colspan="6">Paid Amount : </td>
                                            <td style="text-align: center"><strong>{{ $payment->paid_amount }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;" colspan="6">Due Amount : </td>
                                            <td style="text-align: center"><strong>{{ $payment->due_amount }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; font-size: 16px; font-weight:700;" colspan="6">Grand Total : </td>
                                            <td style="text-align: center"><strong>{{ $payment->total_amount }}</strong></td>
                                        </tr>
                                    </table>
                                    <button type="submit" class="btn btn-sm btn-success mt-3">Invoice Approve</button>
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
@endsection
