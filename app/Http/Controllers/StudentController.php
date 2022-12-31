<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
   
    //create
    public function add(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'course' => 'required',
        ]);

       $student = Student::create($request->all());
       
        return response()->json($student, 201); //created
    }

    //read
    public function view($id){
        $student = Student::find($id);
        if(is_null($student)){
            return response()->json(["Message" => "Data cannot be found!"], 404); //Not found
        }

        return response()->json($student, 200); //OK
     }

    //update
    public function edit(Request $request, $id){
        $student = Student::find($id);
        if(is_null($student)){
            return response()->json(["Message" => "Update failed as data does not exist!"], 404); //Not found
        }
        $student -> update($request->all());
       
        return response()->json($student, 200); //OK
    }

    //delete
    public function delete(Request $request, $id){
        $student = Student::find($id);
        if(is_null($student)){
            return response()->json(["Message" => "Deletion failed as data does not exist!"], 404); //Not found
        }
        $student ->delete();
       
        return response()->json(["Message" => " Data deleted!"], 200); //OK
    }
}


