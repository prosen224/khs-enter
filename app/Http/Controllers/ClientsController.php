<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use Validator;

class ClientsController extends Controller
{
    public $return;
    public function  __construct(){
        $this->return = array(
            'status' => false,
            'message' => '',
            'data' => null
        );
    }

    public function index()
    {
        $data = Clients::all();
        return view('Frontend.Clients.index', ['clients'=>$data]);
    }


    public function new(){
        return view('Frontend.Clients.new');
    }

    public function store(Request $request){

        $validator = null;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'rate' => 'required|min:1'
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $client = new Clients();
            $message = "Client added successfully!";
            if($request->id){
                $client = Clients::find($request->id);
                $message = "Client updated successfully!";
            }
            $client->name = $request->name;
            $client->rate = $request->rate;
            $client->save();
            $this->return = [
                "status" => "success",
                "message" => $message,
                "redirect" => route('clients')
            ];
        }
        return response()->json($this->return);
    }

    public function edit($id){
        $model = Clients::find($id);
        return view('Frontend.Clients.new', ['model'=> $model]);
    }
    
    public function delete($ddd){
        $delete = Clients::find($ddd)->delete();
        return redirect('clients');
    }

}
