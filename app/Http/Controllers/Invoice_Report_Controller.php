<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class Invoice_Report_Controller extends Controller
{

     public function index(){
         return view('reports.invoices_report');
     }



    public function Search_invoices(Request $request)
    {

        $rdio = $request->rdio;


        // في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {


            // في حالة عدم تحديد تاريخ
            if ($request->type == 'كل الفواتير' && $request->start_at == '' && $request->end_at == ''){

                $invoices = Invoice::all();
                $type = $request->type;
                return view('reports.invoices_report', compact('type'))->withDetails($invoices);


            }elseif ($request->type == 'كل الفواتير' && isset($request->start_at)   && isset($request->end_at )){

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;
                $invoices = Invoice::whereBetween('invoice_date', [$start_at, $end_at])->get();
                return view('reports.invoices_report', compact('type', 'start_at', 'end_at'))->withDetails($invoices);

            }elseif ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = Invoice::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report', compact('type'))->withDetails($invoices);

            } // في حالة تحديد تاريخ استحقاق
            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = Invoice::whereBetween('invoice_date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
                return view('reports.invoices_report', compact('type', 'start_at', 'end_at'))->withDetails($invoices);

            }


        }else {
//====================================================================
// في البحث برقم الفاتورة

            $invoices = Invoice::where('invoice_number', '=', $request->invoice_number)->first();
            return view('reports.invoices_report')->withDetails($invoices);

        }


    }



}
