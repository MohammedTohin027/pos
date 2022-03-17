<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Wise Stock Report PDF</title>

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td width="25%" style="text-align: left font-size:bold"></td>
                        <td width="45%" style="text-align: center">
                            <span style="font-size: 25px; font-weight:700; background-color:rgb(173, 172, 172)">Khadija
                                &
                                Samia Fashion</span>
                            <br>
                            Hazi Market, Gorgoriya Masterbari,
                            <br>
                            Gazipur, Dhaka.
                        </td>
                        <td width="30%" style="text-align: right">
                            Shpo No : # 234
                            <br>
                            Owner No : 01854229083
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <hr style="margin-bottom: 0px">

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <span><p style="background-color: rgb(158, 156, 156)" style="text-align: center; margin-bottom: 10px;"><strong><u>Product Wise Stock Report</u></strong></p></span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <span><p style="margin-bottom: 10px;"><strong>Product Name : </strong>{{ $product->name }}</p></span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table border="1" width="100%" style="margin-bottom: 6px">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Category Name</th>
                        <th>In Qty</th>
                        <th>Out Qty</th>
                        <th>Current Stock</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $buying_total = App\Models\Purchase::where('category_id', $product->category_id)->where('product_id',$product->id)->where('status', '1')->sum('buying_qty');
                        $selling_total = App\Models\InvoiceDetails::where('category_id', $product->category_id)->where('product_id',$product->id)->where('status', '1')->sum('selling_qty')
                    @endphp
                    <tr>
                        <td>{{ $product->supplier->name }}</td>
                        <td>{{ $category_name }}</td>
                        <td>{{ $buying_total }}</td>
                        <td>{{ $selling_total }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->unit->name }}</td>
                    </tr>
                </tbody>
            </table>
            @php
                $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
            @endphp
            <i style="margin-top: 6px">Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>
        </div>

        <div class="card-body" style="margin-top: 60px">
            <div class="row">
                <div class="col-md-12">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td width="30%" style="text-align: left; margin-left: 20px;"></td>
                                <td width="40%" style="text-align: center;"><p style="border-top: 1px solid #000">Owner Signature</p></td>
                                <td width="30%" style="text-align: right; margin-right: 20px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
