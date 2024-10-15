<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoices_attachments;
use App\Models\invoices_detales;
use App\Models\product;
use App\Models\Section;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $invoices = Invoice::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


             if ($request->hasFile('pic')){
                 $request->validate([
                    'invoice_number'       =>'required|unique:invoices',
                    'invoice_Date'         =>'required',
                    'Section'              =>'required',
                    'product'              =>'required',
                    'Amount_collection'    =>'required',
                    'Amount_Commission'    =>'required',
                    'Discount'             =>'required',
                    'Rate_VAT'             =>'required',
                    'Value_VAT'            =>'required',
                    'Total'                =>'required',

                ]);



                    Invoice::create([
                        'invoice_number'      => $request->invoice_number,
                        'invoice_date'        => $request->invoice_Date,
                        'due_date'            => $request->Due_date,
                        'product'             => $request->product,
                        'section_id'          => $request->Section,
                        'amount_collction'    => $request->Amount_collection,
                        'amount_commission'   => $request->Amount_Commission,
                        'discount'            => $request->Discount,
                        'rate_vat'            => $request->Rate_VAT,
                        'value_vat'           => $request->Value_VAT,
                        'total'               => $request->Total,
                        'status'              => 'غير مدفوعة',
                        'value_status'        => 2,
                        'note'                => $request->note,
                    ]);


                     $invoice_id = Invoice::latest()->first()->id;


                    invoices_detales::create([

                        'invoice_id'       =>$invoice_id,
                        'invoice_number'   => $request->invoice_number,
                        'product'          => $request->product,
                        'section'          => $request->Section,
                        'status'           =>'غير مدفوعة',
                        'value_status'     => 2,
                        'note'             => $request->note,
                        'user'             => Auth::user()->name,

                    ]);

                $file           = $request->file('pic');
                $file_name       = $file->getClientOriginalName();

                invoices_attachments::create([

                    'file_name'           => $file_name,
                    'invoice_number'      => $request->invoice_number,
                    'created_by'          => Auth::user()->name,
                    'invoice_id'          => $invoice_id ,

                ]);
                $request->file('pic')->storeAs($request->invoice_number, $file_name, 'public_upload');

             }else{

                $validation = $request->validate([
                    'invoice_number'       =>'required|unique:invoices',
                    'invoice_Date'         =>'required',
                    'Section'              =>'required',
                    'product'              =>'required',
                    'Amount_collection'    =>'required',
                    'Amount_Commission'    =>'required',
                    'Discount'             =>'required',
                    'Rate_VAT'             =>'required',
                    'Value_VAT'            =>'required',
                    'Total'                =>'required',

                ]);



                    Invoice::create([
                        'invoice_number'               => $request->invoice_number,
                        'invoice_date'                 => $request->invoice_Date,
                        'due_date'                     => $request->Due_date,
                        'product'                      => $request->product,
                        'section_id'                   => $request->Section,
                        'amount_collction'             => $request->Amount_collection,
                        'amount_commission'            => $request->Amount_Commission,
                        'discount'                     => $request->Discount,
                        'rate_vat'                     => $request->Rate_VAT,
                        'value_vat'                    => $request->Value_VAT,
                        'total'                        => $request->Total,
                        'status'                       => 'غير مدفوعة',
                        'value_status'                 => 2,
                        'note'                         => $request->note,
                    ]);


                     $invoice_id = Invoice::latest()->first()->id;


                    invoices_detales::create([

                        'invoice_id'       =>$invoice_id,
                        'invoice_number'   => $request->invoice_number,
                        'product'          => $request->product,
                        'section'          => $request->Section,
                        'status'           =>' غير مدفوعة',
                        'value_status'     => 2,
                        'note'             => $request->note,
                        'user'             => Auth::user()->name,

                    ]);

             }




             session()->flash('Add','تم اضافة الفاتورة بنجاح');
             return redirect()->back();


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $invoice = Invoice::where('id',$id)->first();

        return view('invoices.status_update',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $invoice  = Invoice ::where('id',$id)->first();
        $sections = Section ::all();

         return view('invoices.edit_invoice',compact('invoice','sections'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $invoices = invoice::findorfail($request->id);
        $detales  = invoices_detales::where('invoice_id',$request->id)->get();
        $attachments  = invoices_attachments::where('invoice_id',$request->id)->get();
        $invoices->update([
            'invoice_number'          => $request->invoice_number,
            'invoice_date'            => $request->invoice_Date,
            'due_date'                => $request->Due_date,
            'product'                 => $request->product,
            'section_id'              => $request->Section,
            'amount_collction'        => $request->Amount_collection,
            'amount_commission'       => $request->Amount_Commission,
            'discount'                => $request->Discount,
            'rate_vat'                => $request->Rate_VAT,
            'value_vat'               => $request->Value_VAT,
            'total'                   => $request->Total,
            'note'                    => $request->note,
        ]);

        foreach ($detales as $detale) {
            $detale->update([
                'invoice_number'   => $request->invoice_number,
                'product'          => $request->product,
                'section'          => $request->Section,
                'note'             => $request->note,

            ]);
        }

        foreach ($attachments as $attachment) {
            $attachment->update([


                'invoice_number' => $request->invoice_number,

            ]);
        }
        $old_path = public_path().'/Attachment/'.$request->old_invoice_number;
        $new_path = public_path().'/Attachment/'.$request->invoice_number;
        File::moveDirectory( $old_path,  $new_path);





        session()->flash('edit','تم تعديل الفاتورة بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoice = Invoice::where('id',$request->invoice_id)->first();
        $invoice_number = $invoice->invoice_number;

        $id_page = $request->id_page;

        if($id_page == 2){

            $invoice->Delete();
            session()->flash('Archive_invoice');
            return redirect('/invoices');

        }else{

            $path = public_path().'/Attachment/'.$invoice->invoice_number;

            if(File::exists($path)){
                File::deleteDirectory($path);
            }

            $invoice->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');

        }

    }


    /////////////////////////////////////////////
    public function Status_Update($id , Request $request){
        $invoice = Invoice::where('id',$id)->first();

        if($request->Status === 'مدفوعة'){

            $invoice->update([

                'status'           =>$request->Status ,
                'value_status'     => 1,
                'payment_date'     =>$request->Payment_Date,
            ]);

            invoices_detales::create([

                'invoice_id'       =>$request->id,
                'invoice_number'   => $request->invoice_number,
                'product'          => $request->product,
                'section'          => $request->Section,
                'status'           =>$request->Status ,
                'value_status'     => 1,
                'payment_date'     =>$request->Payment_Date,
                'note'             => $request->note,
                'user'             => Auth::user()->name,
            ]);
        }else{

            $invoice->update([

                'status'=>$request->Status ,
                'value_status'=> 3,
                'payment_date'=>$request->Payment_Date,
            ]);

            invoices_detales::create([

                'invoice_id'       =>$request->id,
                'invoice_number'   => $request->invoice_number,
                'product'          => $request->product,
                'section'          => $request->Section,
                'status'           =>$request->Status ,
                'value_status'     => 3,
                'payment_date'     =>$request->Payment_Date,
                'note'             => $request->note,
                'user'             => Auth::user()->name,
            ]);

        }
        session()->flash('Status_Update');
        return redirect('/Archive');

    }
    ////////////////////////////////////////////////

    public function invoice_paid(){
        $invoices = Invoice::where('value_status' , 1 )->get();
        return view('invoices.invoice_paid' , compact('invoices'));
    }


    public function invoice_unpaid(){
        $invoices = Invoice::where('value_status' , 2 )->get();
        return view('invoices.invoice_unpaid' , compact('invoices'));
    }



    public function invoice_partail(){
        $invoices = Invoice::where('value_status' , 3 )->get();
        return view('invoices.invoice_partail' , compact('invoices'));
    }
    /////////////////////////////////////////////////
    public function Print_invoice($id){
        $invoice = Invoice::where('id' , $id )->first();
        return view('invoices.print_invoice' , compact('invoice'));
    }


    //////////////////////////////////////////////////
    public function getproduct($id)
    {
        $product = product::where('section_id',$id)->pluck('product_name','id');
        return json_encode($product);
    }


}
