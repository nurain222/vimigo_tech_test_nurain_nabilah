<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Imports\StudentImport;
use Excel;

class StudentResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::paginate(5);

        return response()->json($student, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'course' => 'required',
        ]);

       $student = Student::create($request->all());

       $display = [
        'name'=> $student->name,
        'address'=> $student->address,
       ];
       
        return response()->json($display, 201); //created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        if(is_null($student)){
            return response()->json(["Message" => "Data cannot be found!"], 404); //Not found
        }
        
       $display = [
        'name'=> $student->name,
        'address'=> $student->address,
       ];

        return response()->json($display, 200); //OK
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
        $student = Student::find($id);
        if(is_null($student)){
            return response()->json(["Message" => "Update failed as data does not exist!"], 404); //Not found
        }
        $student -> update($request->all());

       $display = [
        'name'=> $student->name,
        'address'=> $student->address,
       ];
       
        return response()->json($display, 200); //OK
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if(is_null($student)){
            return response()->json(["Message" => "Deletion failed as data does not exist!"], 404); //Not found
        }
        $student ->delete();
       
        return response()->json(["Message" => " Data deleted!"], 200); //OK
    }

    public function import(Request $request){
        Excel::import(new StudentImport, $request->file);

        return response()->json(["Message" => " Students are uploaded!"], 200); //OK
    }


    
}
