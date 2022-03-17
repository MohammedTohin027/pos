<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class StockController extends Controller
{
    //  stock Report
    public function stockReport(){
        // dd('ok');
        $data['allData'] = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->get();
        return view('backend.stock.stock-report', $data);
    }

    //  stock Report Pdf
    public function stockReportPdf(){
        // dd('ok');
        $data['allData'] = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->get();
        $pdf = PDF::loadView('backend.pdf.stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //  supplier Product Wise Report
    public function supplierProductWiseReport(){
        // dd('ok');
        $data['categories'] = Category::orderBy('name', 'ASC')->get();
        $data['suppliers'] = Supplier::orderBy('name', 'ASC')->get();
        return view('backend.stock.supplier-product-wise-report', $data);
    }
    //  supplier Wise Report Pdf
    public function supplierWiseReportPdf(Request $request){
        // dd($request->all());
        $data['supplier_name'] = Supplier::findOrFail($request->supplier_id)->name;
        // dd($data['supplier_name']);
        $data['allData'] = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->where('supplier_id', $request->supplier_id)->get();
        $pdf = PDF::loadView('backend.pdf.supplier-wise-product-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //  Product Wise Report Pdf
    public function ProductWiseReportPdf(Request $request){
        // dd($request->all());
        $data['category_name'] = Category::findOrFail($request->category_id)->name;
        $data['product'] = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
        // dd($data['allData']);
        $pdf = PDF::loadView('backend.pdf.product-wise-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
