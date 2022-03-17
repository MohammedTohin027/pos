@extends('layouts.admin-layout')

@section('title')
    ABC School | Supplier/Product Wise Report
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Supplier/Product Wise Report</h1>
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
                                    Select Criteria
                                </h3>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <strong>Supplier wise report</strong>
                                        <input type="radio" name="supplier_product_wise" value="supplier_wise"
                                            class="search_value"> &nbsp;&nbsp;
                                        <strong>Product wise report</strong>
                                        <input type="radio" name="supplier_product_wise" value="product_wise"
                                            class="search_value">
                                    </div>
                                </div>
                                <div class="show_supplier" style="display: none">
                                    <form action="{{ route('stock.report.supplier.wise.pdf') }}" method="get"
                                        id="supplierWiseForm">
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <label for="">Supplier Name</label>
                                                <select name="supplier_id" id="supplier_id"
                                                    class="form-control form-control-sm select2">
                                                    <option value="">Select Supplier</option>
                                                    @foreach ($suppliers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4" style="padding-top: 30px">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                        class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="show_product_form" style="display: none">
                                    <form action="{{ route('stock.report.product.wise.pdf') }}" method="get"
                                        id="productWiseForm">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Category Name</label>
                                                <select name="category_id" id="category_id" class="form-control select2"
                                                    style="width: 100%;">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Product Name</label>
                                                <select name="product_id" id="product_id" class="form-control select2"
                                                    style="width: 100%;">
                                                    <option value="">Select Product</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" style="padding-top: 30px">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                        class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

    <script>
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'supplier_wise') {
                $('.show_supplier').show();
            } else {
                $('.show_supplier').hide();
            }

            if (search_value == 'product_wise') {
                $('.show_product_form').show();
            } else {
                $('.show_product_form').hide();
            }
        })
    </script>

    <script>
        $(function() {
            $(document).on('change', '#category_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('default.get-all-product') }}",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Product</option>'
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.name +
                                '</option>'
                        });
                        $('#product_id').html(html);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#supplierWiseForm').validate({
                ignore: [],
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "supplier_id") {
                        error.insertAfter(element.next());
                    }
                },
                errorClass: 'text-danger',
                validClass: 'text-success',
                rules: {
                    supplier_id: {
                        required: true,
                    },
                },
                messages: {

                },
            });
            $('#productWiseForm').validate({
                ignore: [],
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "category_id") {
                        error.insertAfter(element.next());
                    } else if (element.attr("name") == "product_id") {
                        error.insertAfter(element.next());
                    } else {
                        error.insertAfter(element);
                    }
                },
                errorClass: 'text-danger',
                validClass: 'text-success',
                rules: {
                    category_id: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                },
                messages: {

                },
            });
        });
    </script>

@endsection
