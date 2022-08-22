<?php

    namespace App\Http\Controllers;

    use App\Models\Technician;
    use Illuminate\Http\Request;
    use Validator;
    
    class TechnicianController extends Controller{
        public $return;
        public function  __construct(){
            $this->return = array(
                'status' => false,
                'message' => '',
                'data' => null
            );
        }

        public function index(){
            $data = Technician::all();
            return view('Frontend.Technician.index', ['technicians'=>$data]);
        }

        public function new(){
            $model = new Technician();
            return view('Frontend.Technician.new', ['model'=>$model]);
        }

        public function store(Request $request){
            $validator = null;
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2',
            ]);
            if ($validator->fails()) {
                $this->return = [
                    "status" => "error",
                    "errors" => $validator->errors(),
                ];
            }else{
                $technician = new Technician();
                $message = "Technician added successfully!";
                if($request->id){
                    $technician = Technician::find($request->id);
                    $message = "Technician updated successfully!";
                }
                $technician->name = $request->name;
                $technician->save();
                $this->return = [
                    "status" => "success",
                    "message" => $message,
                    "redirect" => route('technician')
                ];
            }
            return response()->json($this->return);
        }

        public function edit($id){
            $model = Technician::find($id);
            return view('Frontend.Technician.new', ['model'=> $model]);
        }

        public function delete($bbb){
            $delete = Technician::find($bbb)->delete();
            return redirect('technician');
        }
    }