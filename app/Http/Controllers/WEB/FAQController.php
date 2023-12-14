<?php

namespace App\Http\Controllers\WEB;

use App\DataTables\FaqDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FaqDataTable $dataTable)
    {
        return $dataTable->render('faq.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Faq::create([
            'question'=>$request->question,
            'answer'=>$request->answer
        ]);
        return redirect()->back()->with('message', 'FAQ Created!');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq=Faq::findorfail($id);
        return view('faq.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq=Faq::findorfail($id);
        $faq->update([
            'question'=>$request->question,
            'answer'=>$request->answer
        ]);
        return redirect()->back()->with('message', 'FAQ Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq=Faq::findorfail($id);
        if($faq){
            $faq->delete();
            return redirect()->back()->with('message', 'FAQ Deleted!');
        }
        return redirect()->back()->withErrors(['msg' => 'FAQ not Found']);
    }
}
