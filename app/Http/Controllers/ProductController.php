<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $products = product::all();
        return view('products.products',compact('sections','products'));
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


        $validation = $request->validate([
            'product_name'=>'required|unique:products|max:255',
            'description' =>'required',
            'section_id' =>'required',
        ],[
            'product_name.required'=>'يرجي ادخال المنتج',
            'product_name.unique' => ' المنتج مسجل مسبقا',
            'product_name.max:255'=>' لقد تجاوزت الحد الاقصي للاحرف',
            'decription.required' =>'يرجي ادخال البايانات',
            'section_id.required' =>'يرجي ادخال القسم',
        ]);



        product::create([
            'product_name'=>$request->product_name,
            'description' =>$request->description,
            'section_id' => $request->section_id
        ]);
    // $b_exists = Section::where('section_name',$request->section_name)->exists();

    // if ( $b_exists) {
    //     session()->flash('Error','القسم مسجل مسبقا');
    //     return redirect('/sections');
    // }else{
    //     Section::create([
    //         'section_name'=>$request->section_name,
    //         'decription' =>$request->decription,
    //         'created_by' => Auth::user()->name
    //     ]);
    // }

    session()->flash('Addpro','تم اضافة المنتج بنجاح');
    return redirect('/products');

    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validation = $request->validate([
            'product_name'=>'required||unique:products|max:255',
            'description' =>'required',

        ],[
            'product_name.required'=>'يرجي ادخال المنتج',
            'product_name.unique' => ' المنتج مسجل مسبقا',
            'product_name.max'=> 'لقد تجاوزت الحد الاقصي للاحرف',
            'decription.required' => 'يرجي ادخال البايانات',

        ]);

        $section_id = Section::where('section_name',$request->section_name)->first()->id;

        $products = product::find($id);
        $products->update([
            'product_name'=>$request->product_name,
            'description' =>$request->description,
            'section_id' =>  $section_id
        ]);


        session()->flash('Editpro','تم تعديل المنتج بنجاح');
        return redirect('/products');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        product::find($id)->delete();
        session()->flash('deletepro','تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
