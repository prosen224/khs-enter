<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technician;
use App\Models\Clients;
use App\Models\Information;
use App\Models\Typeofwork;
use Facade\FlareClient\Http\Client;
use Validator;
use PDF;

class InfromationController extends Controller
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

        // $data = Information::where("billable", "No")->get();
        // foreach ($data as $key => $value) {
        //     $find = Information::find($value->id);
        //     $find->billable = 0;
        //     $find->save();
        // }

        $information = Information::with(['my_client','my_technician','my_typeofwork']);
        // sorting start here
        if(isset($_GET["sort_by"])){
            if($_GET["sort_by"] == "id"){
                $information = $information->orderBy('id', 'DESC');
            }elseif ($_GET["sort_by"] == "date") {
                $information = $information->orderBy('date', 'DESC');
            }elseif ($_GET["sort_by"] == "technician") {
                $information = $information->orderBy('technician_id', 'DESC');
            }elseif ($_GET["sort_by"] == "client") {
                $information = $information->orderBy('client_id', 'DESC');
            }elseif ($_GET["sort_by"] == "type_of_work") {
                $information = $information->orderBy('typeofwork_id', 'DESC');
            }elseif ($_GET["sort_by"] == "billable") {
                $information = $information->orderBy('billable', 'DESC');
            }elseif ($_GET["sort_by"] == "bill_info") {
                $information = $information->orderBy('billed_info', 'DESC');
            }elseif ($_GET["sort_by"] == "payment_info") {
                $information = $information->orderBy('payment_info', 'DESC');
            }elseif ($_GET["sort_by"] == "status") {
                $information = $information->orderBy('status', 'DESC');
            }
            
        }
        $information = $information->orderby('created_at', 'DESC')->paginate(30);
        // $information = $information->orderby('created_at', 'DESC')->get()->count();
        // dd($information);
        
        // paginate(30);
        // dd($information);

        // $information->get();
        return view('Frontend.Information.index', ['information'=>$information]);
    }
    public function new(){
        $technican = Technician::all();
        $client = Clients::all();
        $typeofwork = Typeofwork::all();
        return view('Frontend.Information.new',['technican'=>$technican,'client'=>$client,'typeofwork'=>$typeofwork]);
    }

    public function store(Request $request){
        $validator = null;
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'technician' => 'required',
            'client' => 'required',
            'typeofwork' => 'required',
            // 'hours' => 'required',
            // 'minutes' => 'required',
            'billable' => 'required',
            // 'billed_info' => 'required',
            // 'payment_info' => 'required',
            'details' => 'required',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $model = new Information();
            $message = "Information added successfully!";
            if($request->id){
                $model = Information::find($request->id);
                $message = "Information updated successfully!";
            }

            $model->date = $request->date;
            $model->technician_id = $request->technician;
            $model->client_id = $request->client;
            $model->rate = Clients::find($request->client)->rate;
            $model->typeofwork_id = $request->typeofwork;
            // $model->hours = $request->hours;
            // $model->minutes = $request->minutes;
            $model ->duration =  $request->hours. " Hrs " .$request->minutes. " Mins";
            $model->billable = $request->billable;
            $model->billed_info = $request->billed_info;
            $model->payment_info = $request->payment_info;
            $model->details = $request->details;
            $model->save();
            $this->return = [
                "status" => "success",
                "message" => $message,
                "redirect" => route('information')
            ];
        }
        return response()->json($this->return);
    }
    public function edit($id)
    {
        $technican = Technician::all();
        $client = Clients::all();
        $typeofwork = Typeofwork::all();
        $model = Information::find($id);
        return view('Frontend.Information.new',['technican'=>$technican,'client'=>$client,'typeofwork'=>$typeofwork,'model'=>$model]);
    }

    public function view($id)
    {
        $model = Information::with(['my_client','my_technician','my_typeofwork'])->find($id);
        return view('Frontend.Information.view',['information'=>$model]);
    }

    public function changeStatus($id)
    {
        Information::find($id)->update(['status'=>1]);
        return redirect()->route('information');
    }

    public function report(Request $request)
    {
        $client_id = $request->client;
        $from_date = $request->start_date;
        $to_date = $request->end_date;
        $status = $request->approved_report;
        $bill_payment = $request->bill_payment;
        if(isset($_GET['client_name'])){
            $client_id = $_GET['client_name'];
        }
        if(isset($_GET['start_date'])){
            $from_date = $_GET['start_date'];
        }
        if(isset($_GET['end_date'])){
            $to_date = $_GET['end_date'];
        }
        if(isset($_GET['approved_report']) && $_GET['approved_report'] != ""){
            $status = $_GET['approved_report'];
        }
        if(isset($_GET['bill_payment'])){
            $bill_payment = $_GET['bill_payment'];
        }

        if($from_date){
            $from_date = date('Y-m-d',strtotime($from_date)); //.' 00:00:00'; ;
        }
        if($to_date){
            $to_date = date('Y-m-d',strtotime($to_date)); //.' 23:59:59'; ;
        }
        $client_name = '';
        $data = Information::with('my_client');
        if($from_date !='' && $to_date !=''){
            $data->whereBetween('date', [$from_date, $to_date]);
        }
        if($client_id != ''){
            $data->where('client_id',$client_id);
            $client_name = Clients::find($client_id)->name;
        }
        if($status != ""){
            $data->where( 'status',  $status );
        }

        // $data = $data->get();
        // // if ajax request
        // if ($request->ajax()) {
        //     $my_html_view = view('Frontend.Information.my_report',['information'=>$data,'start_date'=>$from_date , 'end_date'=>$to_date, 'client_name'=>$client_name,'bill_payment'=>$bill_payment])->render();
        //     return response()->json($my_html_view );
        // }

        // if(isset($_GET['pdf']) == 1){
        //     $pdf = PDF::loadView('Frontend.Information.my_report_pdf',['information'=>$data , 'start_date'=>$from_date , 'end_date'=>$to_date,'client_name'=>$client_name,'bill_payment'=>$bill_payment]);
        //     return $pdf->download('report.pdf');
        // }
        
        // $data1 = $data->where('billable',1)->get();
        // $data2 = $data->where('billable',0)->get();
        
        $my_item =clone  $data;
        $my_item2 =clone  $data;
       
        $data1 = $my_item->where('billable',1)->get();
         $data2 = $my_item2->where('billable',0)->get(); 
        // dd($data2);
        // if ajax request
        if ($request->ajax()) {
            $my_html_view = view('Frontend.Information.my_report',['information'=>$data1,'information2'=>$data2, 'start_date'=>$from_date , 'end_date'=>$to_date, 'client_name'=>$client_name,'bill_payment'=>$bill_payment, "pdf"=>0])->render();
            return response()->json($my_html_view );
        }

        if(isset($_GET['pdf']) == 1){
            $pdf = PDF::loadView('Frontend.Information.my_report_pdf',['information'=>$data1,'information2'=>$data2, 'start_date'=>$from_date , 'end_date'=>$to_date,'client_name'=>$client_name,'bill_payment'=>$bill_payment ,"pdf"=>1 ]);
            return $pdf->download('report.pdf');
        }

        $client = Clients::all();
        return view('Frontend.Information.report',['client'=>$client]);
    }
    
    public function delete($id)
    {
        Information::find($id)->delete();
        return redirect()->route('information');
    }
}
