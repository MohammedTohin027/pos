<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice PDF</title>

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
                        <td width="25%" style="text-align: left font-size:bold">Invoice No: #
                            {{ $invoice->invoice_no }}</td>
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

        <hr>

        <div class="card-body">
            <table border="1" width="50%" style="margin: 0 auto; margin-bottom: 25px">
                <tr>
                    <td colspan="2" style="text-align: center; font-size: 18px; font-weight:700;"><u>Customer
                            Invoice</u>
                    </td>
                </tr>
                <tr>
                    <td width="15%"><strong>Name: </strong></td>
                    <td width="35%">{{ $invoice->payment->customer->name }}</td>
                </tr>
                <tr>
                    <td width="15%"><strong>Mobile: </strong></td>
                    <td width="35%">{{ $invoice->payment->customer->mobile }}</td>
                </tr>
                <tr>
                    <td width="15%"><strong>Address: </strong></td>
                    <td width="35%">{{ $invoice->payment->customer->address }}</td>
                </tr>
            </table>
        </div>

        <div class="card-body">
            @php
                $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
            @endphp
            <table border="1" width="100%" style="margin-bottom: 6px">
                <tr style="text-align: center">
                    <th width="8%">SL.</th>
                    <th width="15%">Category</th>
                    <th>Product Name</th>
                    <th width="11%">Quantity</th>
                    <th width="12%">Unit Price</th>
                    <th width="13%">Total Price</th>
                </tr>
                @php
                    $total_sum = 0;
                @endphp
                @foreach ($invoice->invoice_details as $key => $item)
                    <tr style="text-align: center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->product->name }} </td>
                        <td>{{ $item->selling_qty }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->selling_price }}</td>
                    </tr>
                    @php
                        $total_sum += $item->selling_price;
                    @endphp
                @endforeach
                <tr>
                    <td style="text-align: right; font-size: 16px; font-weight:700;" colspan="5"><strong>Sub Total :
                        </strong></td>
                    <td style="text-align: center"><strong>{{ $total_sum }}</strong></td>
                </tr>
                <tr>
                    <td style="text-align: right;" colspan="5">Discount : </td>
                    <td style="text-align: center"><strong>{{ $payment->discount_amount }}</strong></td>
                </tr>
                <tr>
                    <td style="text-align: right;" colspan="5">Paid Amount : </td>
                    <td style="text-align: center"><strong>{{ $payment->paid_amount }}</strong></td>
                </tr>
                <tr>
                    <td style="text-align: right;" colspan="5">Due Amount : </td>
                    <td style="text-align: center"><strong>{{ $payment->due_amount }}</strong></td>
                </tr>
                <tr>
                    <td style="text-align: right; font-size: 16px; font-weight:700;" colspan="5"><strong>Grand Total :
                        </strong></td>
                    <td style="text-align: center"><strong>{{ $payment->total_amount }}</strong></td>
                </tr>
            </table>
            @php
                $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
            @endphp
            <i style="margin-top: 10px">Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>
        </div>

        <div class="card-body" style="margin-top: 30px">
            <div class="row">
                <div class="col-md-12">
                    <hr style="margin-bottom: 0px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td width="40%" style="text-align: left; margin-left: 20px;">Customer Signature</td>
                                <td width="20%"></td>
                                <td width="40%" style="text-align: right; margin-right: 20px;">Seller Signature</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
