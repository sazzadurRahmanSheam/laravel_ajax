<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
   public function index(){
   	return view('pages.index');
   }

   public function store(Request $request){
   		// dd($request);
		if (($request->work_function=="insert")&&($request->ID=="")) {
			$request->validate([
				'firstName' => 'required',
				'lastName' => 'required',
			]);
			$data = new Student;
			$data->firstName = $request->firstName;
			$data->lastName = $request->lastName;
			if ($data->save()) {
				return json_encode(array(
	            	"successMessage"=>"Data Inserted Successful"
	        	));
			}
		}
		else if(($request->work_function=="update")&& isset($request->ID) && ($request->ID != "") ){
			$request->validate([
				'firstName' => 'required',
				'lastName' => 'required',
			]);

			$data = Student::find($request->ID);
			$data->firstName = $request->firstName;
			$data->lastName = $request->lastName;
			if ($data->save()) {
				return json_encode(array(
	            	"successMessage"=>"Updated Successful"
	        	));
			}
		}
	}

	public function getData(){
		$data = Student::get();
		return json_encode(array('data'=>$data));
	}


	public function destroy($id){
		Student::find($id)->delete();
		return json_encode(array(
			"deleteMessage"=>"Deleted Successful"
		));
	}

	public function edit($id){
		$data = Student::find($id);
		//dd($data);
		return json_encode(array('data'=>$data));

	}



}
