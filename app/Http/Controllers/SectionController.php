<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections',compact('sections'));
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
        $input = $request->all();

            $validation = $request->validate([
                'section_name'=>'required|unique:sections|max:255',
                'decription' =>'required',
            ],[
                'section_name.unique'=>'القسم مسجل مسبقا',
                'decription' =>'يرجي ادخال البايانات'
            ]);



            Section::create([
                'section_name'=>$request->section_name,
                'decription' =>$request->decription,
                'created_by' => Auth::user()->name
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

        session()->flash('Add','تم اضافة القسم بنجاح');
        return redirect('/sections');

    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $validation = $request->validate([
            'section_name'=>'required|max:255|unique:sections,section_name,'.$id,
            'decription' =>'required',
        ],[
            'section_name.unique'=>'القسم مسجل مسبقا',
            'decription' =>'يرجي ادخال البايانات'
        ]);

        $section = Section::find($id);
        $section->update([
            'section_name'=>$request->section_name,
            'decription' =>$request->decription,
        ]);

        session()->flash('ُEdit','تم تعديل القسم بنجاح');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();

        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
