<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function Laravel\Prompts\error;

class Custormers_Report_Controller extends Controller
{
    public function index(){

        $sections = Section::all();
        return view('reports.customers_report',compact('sections'));

    }


    public function Search_customers(Request $request){


// في حالة البحث بدون التاريخ
        if ($request->Section == null && $request->product == null && $request->start_at =='' && $request->end_at=='') {

            $invoices = Invoice::all();
            $sections = Section::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);

        }elseif($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


            $invoices = Invoice::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            $sections = Section::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);


        }elseif($request->Section && $request->product && $request->start_at  && $request->end_at == '') {

            $start_at = date($request->start_at);
            $end_at = Carbon::now()->format('Y-m-d');
            $invoices = Invoice::whereBetween('invoice_date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();            $sections = Section::all();
            $sections = Section::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);

        }elseif($request->Section && $request->product && $request->start_at  && $request->end_at ) {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = Invoice::whereBetween('invoice_date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            $sections = Section::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);

        }elseif ($request->Section == '' && $request->product == ''&& $request->start_at  && $request->end_at){

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = Invoice::whereBetween('invoice_date',[$start_at,$end_at])->get();
            $sections = Section::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);

        }elseif ($request->Section == '' && $request->product == '' && $request->start_at && $request->end_at ==''){

            $start_at = date($request->start_at);
            $end_at = Carbon::now()->format('Y-m-d');
            $invoices = Invoice::whereBetween('invoice_date',[$start_at,$end_at])->get();
            $sections = Section::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }else {
            session()->flash('error','يرجي ادخال بايانات البحث');
            return redirect()->back();
        }






    }
}
