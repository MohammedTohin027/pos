<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Invoice::orderBy('date','desc')->orderBy('id','DESC')->where('status', '1')->get();
        return view('backend.invoice.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        $invoice_data = Invoice::orderBy('id', 'DESC')->first();
        if ($invoice_data == null) {
            $data['invoice_id'] = 1;
        }
        else{
            $invoice_no = $invoice_data->invoice_no;
            $data['invoice_id'] = $invoice_no + 1;
        }
        $data['date'] = date('Y-m-d', strtotime(Carbon::now()));
        $data['customers'] = Customer::all();
        // $data['customers'] = Customer::select('name')->groupBy('name')->orderBy('name', 'asc')->get();
        $data['categories'] = Category::all();
        return view('backend.invoice.create', $data);
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        if ($request->category_id == null) {
            return redirect()->back()->with('error', 'Sorry! You do not select any item');
        }
        else{
            if ($request->estimated_amount < $request->paid_amount) {
                return redirect()->back()->with('error', 'Total amount smaller than Partical amount');
            }
            else if($request->estimated_amount < $request->discount_amount){
                return redirect()->back()->with('error', 'Total amount smaller than discount amount');
            }
            else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;

                DB::transaction(function() use($request, $invoice){
                    if ($invoice->save()) {
                        if ($request->customer_id == '0') {
                            $customer  = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile = $request->mobile;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        }
                        else{
                            $customer_id = $request->customer_id;
                        }
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++) {
                            $invoice_id = $invoice->id;
                            $invoice_details = new InvoiceDetails();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice_id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '0';
                            $invoice_details->created_by = Auth::user()->id;
                            $invoice_details->save();
                        }
                            $payment = new Payment();
                            $payment_details = new PaymentDetails();
                            $payment->invoice_id = $invoice_id;
                            $payment->customer_id = $customer_id;
                            $payment->paid_status = $request->paid_status;
                            if ($request->paid_status == 'full_paid') {
                                $payment->paid_amount = $request->estimated_amount;
                                $payment->due_amount = '0';
                                $payment_details->current_paid_amount = $request->estimated_amount;
                            }
                            if($request->paid_status == 'full_due'){
                                $payment->paid_amount = '0';
                                $payment->due_amount = $request->estimated_amount;
                                $payment_details->current_paid_amount = '0';
                            }
                            if($request->paid_status == 'partical_paid'){
                                $payment->paid_amount = $request->paid_amount;
                                $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                                $payment_details->current_paid_amount = $request->paid_amount;
                            }
                            $payment->total_amount = $request->estimated_amount;
                            $payment->discount_amount = $request->discount_amount;
                            $payment->save();

                            $payment_details->invoice_id = $invoice_id;
                            $payment_details->date = date('Y-m-d', strtotime($request->date));
                            $payment_details->save();

                    }
                });

            }



        }
        return redirect()->route('invoice.pending.view')->with('success', 'Data Inserted Successfully!');
    }

    //  delete
    public function delete($id){
        // dd($id);
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        InvoiceDetails::where('invoice_id', $id)->delete();
        Payment::where('invoice_id', $id)->delete();
        PaymentDetails::where('invoice_id', $id)->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully!');
    }

    //  purchasePendingList
    public function invoicePendingList(){
        // dd('ok');
        $data['allData'] = Invoice::orderBy('date','desc')->orderBy('id','DESC')->where('status', '0')->get();
        return view('backend.invoice.view-pending-list', $data);
    }

    //  approve
    public function approve($id){
        $data['invoice'] = Invoice::with(['invoice_details'])->findOrFail($id);
        return view('backend.invoice.approve-invoice', $data);
    }
    //  approve
    public function approveStore(Request $request, $id){
        // dd($request->all());
        foreach($request->selling_qty as $key =>$val){
            $invoice_details = InvoiceDetails::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]) {
                return redirect()->back()->with('error', 'Sorry! You approve maximun value');
            }
        }
        $invoice = Invoice::findOrFail($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request, $invoice, $id){
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetails::where('id', $key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = $product->quantity - $request->selling_qty[$key];
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->route('invoice.pending.view')->with('success', 'Invoice Successfully Approved');
    }

    public function printInvoiceList(){
        // dd('ok');
        $data['allData'] = Invoice::orderBy('date','desc')->orderBy('id','DESC')->where('status', '1')->get();
        return view('backend.invoice.pos-invoice-list', $data);
    }

    //  print invoice
    public function printInvoice($id){
        // dd($id);
        $data['allData'] = Invoice::orderBy('date','desc')->orderBy('id','DESC')->where('status', '1')->get();
        return view('backend.invoice.pos-invoice-list', $data);
    }

    function generate_pdf($id) {
        // dd($id);
        $data['invoice'] = Invoice::with(['invoice_details'])->findOrFail($id);
        // dd($data['invoice']);
        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //  dailyReport
    public function dailyReport(){
        return view('backend.invoice.daily-invoice-report');
    }
    //  dailyReportPdf
    public function dailyReportPdf(Request $request){
        $s_date = date('Y-m-d', strtotime($request->start_date));
        $e_date = date('Y-m-d', strtotime($request->end_date));

        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Invoice::whereBetween('date', [$s_date,$e_date])->where('status', '1')->get();
        $pdf = PDF::loadView('backend.pdf.daily-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}