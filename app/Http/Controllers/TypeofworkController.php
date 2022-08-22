<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typeofwork;
use Validator;

class TypeofworkController extends Controller
{
    public $return;
    public function  __construct(){
        $this->return = array(
            'status' => false,
            'message' => '',
            'data' => null
        );
    }

    public function index(){

        $data = Typeofwork::all();
        return view('Frontend.Typeofwork.index',['typeofwork'=>$data]);
    }

    public function new(){
        return view('Frontend.Typeofwork.new');
    }
    
    public function store(request $request){
        $validator = null;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $model = new Typeofwork();
            $message = "Type of work added successfully!";
            if($request->id){
                $model = Typeofwork::find($request->id);
                $message = "Type of work updated successfully!";
            }
            $model->typeofwork = $request->name;
            $model->save();
            $this->return = [
                "status" => "success",
                "message" => $message,
                "redirect" => route('type-of-work')
            ];
        }
        return response()->json($this->return);

    }


    public function edit($id){
        $model = Typeofwork::find($id);
        return view('Frontend.Typeofwork.new', ['model'=> $model]);
    }

    public function delete($fff){
        $delete = Typeofwork::find($fff)->delete();
        return redirect('type-of-work');
    }
}
