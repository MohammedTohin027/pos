@extends('layouts.admin-layout')

@section('title')
    ABC School | Product
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Product</h1>
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
                                    @if(@$editData)
                                    Edit Product
                                    @else
                                    Add Product
                                    @endif
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('product.view') }}"> <i
                                                    class="fa fa-list"></i> Product List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ (@$editData) ? route('product.update', $editData->id) : route('product.store') }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Supplier Name</label>
                                            <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;">
                                                <option value="" selected="selected">Select Supplier</option>
                                                @foreach ($suppliers as $item)
                                                    <option value="{{ $item->id }}" {{ (@$editData->supplier_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Unit Name</label>
                                            <select name="unit_id" id="unit_id" class="form-control select2" style="width: 100%;">
                                                <option value="" selected="selected">Select Unit</option>
                                                @foreach ($units as $item)
                                                    <option value="{{ $item->id }}" {{ (@$editData->unit_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                                <option value="" selected="selected">Select Category</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}" {{ (@$editData->category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Product Name</label>
                                            <input id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" type="text" name="name" value="{{ (@$editData) ? $editData->name : old('name') }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-sm btn-primary">{{ (@$editData) ? 'Update' : 'Submit' }}</button>
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
                    name: {
                        required: true,
                    },
                    supplier_id: {
                        required: true,
                    },
                    unit_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {

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
