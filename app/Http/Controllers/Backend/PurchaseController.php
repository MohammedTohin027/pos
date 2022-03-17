<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PurchaseController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Purchase::orderBy('date','desc')->orderBy('id','DESC')->where('status', '1')->get();
        return view('backend.purchase.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.purchase.create', $data);
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        if ($request->category_id == null) {
            return redirect()->back()->with('error', 'Sorry! You do not select any item');
        }
        else{
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) {
                $data = new Purchase();
                $data->date = date('Y-m-d', strtotime($request->date[$i]));
                $data->supplier_id = $request->supplier_id[$i];
                $data->purchase_no = $request->purchase_no[$i];
                $data->category_id = $request->category_id[$i];
                $data->product_id = $request->product_id[$i];
                $data->buying_qty = $request->buying_qty[$i];
                $data->unit_price = $request->unit_price[$i];
                $data->buying_price = $request->buying_price[$i];
                $data->discription = $request->discription[$i];
                $data->created_by = Auth::user()->id;
                $data->status = '0';
                $data->save();
            }
        }
        return redirect()->route('purchase.pending.view')->with('success', 'Data Inserted Successfully!');
    }

    //  delete
    public function delete($id){
        // dd('ok');
        $data = Purchase::findOrFail($id);
        $data->delete();
        return redirect()->route('purchase.view')->with('success', 'Data Deleted Successfully!');
    }

    //  purchasePendingList
    public function purchasePendingList(){
        // dd('ok');
        $data['allData'] = Purchase::orderBy('date','desc')->orderBy('id','DESC')->where('status', '0')->get();
        return view('backend.purchase.view-pending-list', $data);
    }

    //  approve
    public function approve($id){
        $data = Purchase::findOrFail($id);
        $product = Product::where('id', $data->product_id)->first();
        $purchase_qty = $product->quantity + $data->buying_qty;
        $product->quantity = $purchase_qty;
        if ($product->save()) {
            DB::table('purchases')->where('id', $id)->update(['status' => '1']);
        }
        return redirect()->back()->with('success', 'Data Approved Successfully!');
    }

    //  purchase Report
    public function purchaseReport(){
        return view('backend.purchase.daily-purchase-report');
    }
    //  purchase Report pdf
    public function purchaseReportPdf(Request $request){
        // dd($request->all());
        $s_date = date('Y-m-d', strtotime($request->start_date));
        $e_date = date('Y-m-d', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Purchase::whereBetween('date', [$s_date,$e_date])->where('status', '1')->orderBy('supplier_id','asc')->orderBy('category_id','asc')->orderBy('product_id','asc')->get();
        $pdf = PDF::loadView('backend.pdf.purchase-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
