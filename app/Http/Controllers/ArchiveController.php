<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoices_attachments;
use App\Models\invoices_detales;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.Archive_invoices',compact('invoices'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = Invoice ::onlyTrashed()->where('id',$id)->first();
        $detales  = invoices_detales::where('invoice_id',$id)->get();
        $attachments = invoices_attachments::where('invoice_id',$id)->get();

         return view('invoices.detales',compact('detales','invoice','attachments'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        Invoice::withTrashed()->where('id',$id)->restore();

        session()->flash('restore_invoice');
        return redirect('/invoices');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        Invoice::withTrashed()->where('id',$id)->forceDelete();

        session()->flash('delete_invoice');
        return redirect('/Archive');
    }
}
