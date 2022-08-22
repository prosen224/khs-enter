<?php

namespace App\Http\Controllers\Frontend;
use Validator;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public $return;

    public function __construct()
    {
        $this->return =[
            "status"=>"error"
        ];
    }

    public function switchlang(Request $request, $locale){
        session(['APP_LOCALE'=>$locale]);
        return redirect()->back();
    }


    public function langDataUpdate(Request $request){
        $validator = null;
        $message = "";
        $validator = Validator::make($request->all(), [
            'lang_key' => 'required',
            'lang_val' => 'required',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
        $lang_key = $request->lang_key;
        $value = $request->lang_val;
        $jsonString = file_get_contents(base_path('resources/lang/fr.json'));
        $data = json_decode($jsonString, true);

        if (count($request->lang_key) > 0):
            for ($i = 0; $i < count($lang_key); $i++) {
            $data[$lang_key[$i]] = $value[$i];
            }

        endif;
        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

        // dd($newJsonString);
        file_put_contents(base_path('resources/lang/fr.json'), stripslashes($newJsonString));
        $return = [
            "status"=>"success",
            "message"=>"Data updated successfully"
        ];
    }
        return response()->json($return);

    }

}
