<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoices_attachments;
use App\Models\invoices_detales;
use Illuminate\Container\Attributes\Storage as AttributesStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

use function PHPUnit\Framework\fileExists;

class InvoicesDetalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_detales $invoices_detales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = Invoice ::where('id',$id)->first();
        $detales  = invoices_detales::where('invoice_id',$id)->get();
        $attachments = invoices_attachments::where('invoice_id',$id)->get();

         return view('invoices.detales',compact('detales','invoice','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_detales $invoices_detales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $attavhment = invoices_attachments::findorfail($request->id_file);
        $attavhment->delete();
        $contents = '/'.$request->invoice_number.'/'.$request->file_name;
        Storage::disk('public_upload')->delete($contents);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();


    }


    public function get_file($invoice_number,$file_name)

    {
        $contents = public_path().'/Attachment/'.$invoice_number.'/'.$file_name;
        return  response()->download($contents);
    }

    public function open_file($invoice_number,$file_name)

    {
        $contents = public_path().'/Attachment/'.$invoice_number.'/'.$file_name;
        return  response()->file($contents);
    }


}
