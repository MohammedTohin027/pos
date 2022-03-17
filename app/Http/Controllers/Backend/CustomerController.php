<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CustomerController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Customer::all();
        return view('backend.customer.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        return view('backend.customer.create');
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
        ]);
        $data = new Customer();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('customer.view')->with('success', 'Data Inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd('ok');
        $data['editData'] = Customer::findOrFail($id);
        return view('backend.customer.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$id,
        ]);
        $data = Customer::findOrFail($id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('customer.view')->with('success', 'Data Updated Successfully!');
    }
    //  delete
    public function delete($id){
        // dd('ok');
        $data = Customer::findOrFail($id);
        $data->delete();
        return redirect()->route('customer.view')->with('success', 'Data Deleted Successfully!');
    }

    //  credit customer
    public function creditCustomer(){
        // dd('ok');
        // $data['allData'] = Invoice::where('status', '1')->get();
        $data['allData'] = Payment::whereIn('paid_status', ['partical_paid','full_due'])->get();
        return view('backend.customer.customer-credit', $data);
    }

    //  creditCustomerPdf
    public function creditCustomerPdf(Request $request){
        // dd($data['invoice']);
        $data['allData'] = Payment::whereIn('paid_status', ['partical_paid','full_due'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-credit-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //  creditCustomer Invoice Edit
    public function creditCustomerInvoiceEdit($invoice_id){
        // $data['invoice'] = Invoice::with(['invoice_details'])->findOrFail($id);
        $data['payment'] = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.customer.customer-credit-invoice-edit', $data);
    }

    //  creditCustomer Invoice Edit
    public function creditCustomerInvoiceUpdate(Request $request, $invoice_id){
        // dd($request->all());
        if ($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error', 'Sorry! You have paid maximum value');
        }
        else{
            $payment_details = new PaymentDetails();
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = $payment->paid_amount + $request->new_paid_amount;
                $payment->due_amount = 0;
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }
            else if($request->paid_status == 'partical_paid'){
                $payment->paid_amount = $payment->paid_amount + $request->paid_amount;
                $payment->due_amount = $payment->due_amount - $request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();

            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();
        }
        return redirect()->route('customer.credit')->with('success', 'Invoice Updated Successfully!');
   }

   //  creditCustomerInvoiceDetailsPdf
   public function creditCustomerInvoiceDetailsPdf($invoice_id){
        $data['payment'] = Payment::where('invoice_id', $invoice_id)->first();
        $pdf = PDF::loadView('backend.pdf.invoice-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //  credit customer
    public function paidCustomer(){
        // dd('ok');
        $data['allData'] = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.customer.customer-paid', $data);
    }

    //  creditCustomerPdf
    public function paidCustomerPdf(Request $request){
        // dd($data['invoice']);
        $data['allData'] = Payment::where('paid_status', '!=', 'full_due')->get();
        $pdf = PDF::loadView('backend.pdf.customer-paid-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

     //  customer Wise Report
     public function customerWiseReport(){
        // dd('ok');
        $data['customers'] = Customer::orderBy('name', 'ASC')->get();
        return view('backend.customer.customer-wise-report', $data);
    }

    //  creditCustomerPdf
    public function customerWiseCreditReport(Request $request){
        // dd($data['invoice']);
        $data['allData'] = Payment::where('customer_id', $request->customer_id)->whereIn('paid_status', ['partical_paid','full_due'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-wise-credit-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //  creditCustomerPdf
    public function customerWisePaidReport(Request $request){
        // dd($data['invoice']);
        $data['allData'] = Payment::where('customer_id', $request->customer_id)->where('paid_status', '!=', 'full_due')->get();
        $pdf = PDF::loadView('backend.pdf.customer-wise-paid-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}