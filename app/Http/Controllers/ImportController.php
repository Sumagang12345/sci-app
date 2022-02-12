<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Imports\ExcelImport;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::get();
        if(count($employee) == 0){
            $disabled1 = 'submit';
            $disabled2 = '';
            $disabled3 = '';
        }else{
            $disabled1 = 'button';
            $disabled2 = 'disabled';
            $disabled3 = 'style=cursor:not-allowed;';
        }
        return view('import.import', [
            'title' => 'Import / Export Data'
        ],compact('disabled1','disabled2','disabled3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Excel::download(new ExcelExport, 'SCIDeductions.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::get();
        if(count($employee) == 0){
            Excel::import(new ExcelImport,$request->file('file'));
        return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
