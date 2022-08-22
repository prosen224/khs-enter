<?php
namespace App\Http\Controllers\Auth\User;

use App\Models\Clients;
use App\Models\Information;
use App\Models\Typeofwork;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
class AuthController extends Controller
{

    public $return;
    public function __construct()
    {
        $this->return =[
            "status"=>"error"
        ];
            
    }
    public function index()
    {
        $data = [];
        $data["users"] = User::all()->count();
        $data["technicians"] = User::all()->count();
        $data["clients"] = Clients::all()->count();
        $data["information"] = Information::all()->count();
        $data["typeofwork"] = Typeofwork::all()->count();
        return view("Frontend.Dashboard.index",$data);
    }

    public function login()
    {
        return view('Frontend.User.login');
    }

    public function authenticate(Request $request)
    {
            $validator = null;
            $validator = Validator::make($request->all(), [
                // 'email' => 'required|string|email',
                'name' => 'required',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                $this->return = [
                    "status" => "error",
                    "errors" => $validator->errors(),
                ];
            }else{
            $credentials = $request->only('email','password');
            $remember = $request->get('remember');
            // $activity_query = User::where("email", $request->email)->first();
            $activity_query = User::where("name", $request->name)->first();
            if($activity_query){
                if($activity_query->status != 1){
                    $this->return = [
                        "status"=>"inactive",
                        "message"=>"Your are not a active user. Please contact to the admin about your activity."
                    ];
                }else{
                    if (Auth::guard('web')->attempt(['name' => $request->name, 'password' => $request->password,'status' => "1"])) {
                        $this->return = [
                            "status"=>"success",
                            "message"=>"Welcome! You are successfully login."
                        ];
                    }else{
                        $this->return = [
                            "status"=>"error",
                            "message"=>"Invalid Credentials."
                        ];
                    }
                }
            }else{
                $this->return = [
                    "status"=>"error",
                    "message"=>"We couldn't find your account, please register first."
                ];
            }


        }
        return response()->json($this->return);
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function register()
    {
        $model = new User();
        return view('Frontend.User.registration',['model'=>$model]);
    }

    public function store(Request $request)
    {
        $validator = null;

        $validator = Validator::make($request->all(), [
            'user_name'     => 'required|unique:users,name',
            'role'      => 'required',
            'email'          => 'required|unique:users,email',
            'password'       => 'required',
            'first_name'       => 'required',
            'last_name'       => 'required',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $user = new User();
            if($request->id){
                $user = User::find($request->user_id);
            }
            $vc =  $user->generateCode();
            $user->email = $request->email;
            $user->name = $request->user_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->role = $request->role;
            $user->verify_code = $vc;
            $user->password = bcrypt($request->password);
            if($user->save()){
                // $user->sendVerificationMail($user->id);
                $this->return = [
                    "status"=>"success",
                    "message"=>__("New user registered successfully! .")
                ];
            }
        }
        return response()->json($this->return);
    }

    public function verifyEmail()
    {
        $verify_id = decrypt($_GET["vef"]);
        $verify_query = User::where("verify_code",$verify_id)->first();
        if($verify_query){
            $verify_query->updateRole($verify_query->id);
            Auth::login($verify_query);
            return redirect()->intended(route('home'));
        }else{
            return redirect()->route('login');
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = null;

        $validator = Validator::make($request->all(), [
            'email'          => 'required|email',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
                "message"=>"We couldn't find your account please register first."
            ];
        }else{
            $user_email = $request->email;
            $query = User::where("email",$user_email)->first();
            // dd($query);
            if($query){
                $query->sendForgotPasswordMail($query->id);
                // return 1;
                $this->return = [
                    "status"=>"success",
                    "message"=>"A reset password link sent to your email. Please check your email to reset your password."
                ];
            }else{
                // return 0;
                $this->return =[
                    "status"=>"error",
                    "message"=>"We couldn't find your account please register first."
                ];
            }
        }
        return response()->json($this->return);
    }

    public function setPassword(Request $request,$id)
    {
        $u_id = Crypt::decrypt($id);
        $request->validate([
            'password'     => 'required|min:8',
            'password_mass' => 'required|min:8'
        ]);
        $pass = $request->password;
        $pass_mass = $request->password_mass;
        if($pass == $pass_mass){
            $set_pass_query = User::findOrFail($u_id);
            $set_pass_query->password = bcrypt($request->password);
            if($set_pass_query->save()){
                $this->return =[
                    "status"=>"success",
                    "message"=>"Welcome! Your password reset successfully."
                ];
            }
        }
        return response()->json($this->return);
    }

    function sendMail($to,$user_name)
    {
        $to = "jshohan887@gmail.com";
        // $data = array('name'=>"env('APP_NAME')");

        $data = [
            "to"=>$to,
            "user_name"=>$user_name,
        ];

        Mail::send('mail', $data, function($message) use ($to) {
            $message->to($to, 'Shohan')->subject('Your One time E-mail varification link - env("APP_NAME")');
            $message->from('env("MAIL_FROM_ADDRESS")', "env('APP_NAME')");
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function changePassword(Request $request)
    {
        $validator = null;
        
        $validator = Validator::make($request->all(), [
            'current_pass'  => 'required',
            'new_pass'      => 'required',
            'confirm_pass'  => 'required|same:new_pass',
        ]);
        
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $current_password = $request->current_pass;
            $confirm_password = $request->confirm_pass;
            $new_password = $request->new_pass;
            if($confirm_password == $new_password){
                $user = User::findOrFail(Auth::user()->id);
                if (Hash::check($request->current_pass, $user->password)) {
                    $user->password = bcrypt($new_password);
                    if($user->save()){
                        $this->return = [
                            "status"=>"success",
                            "message"=>"Password changed successfully."
                        ];
                    }
                }else{
                    $this->return = [
                        "status"=>"error",
                        "message"=>"Password doesn't match, If your forgot your password please reset your password."
                    ];
                }
            }else{
                $this->return =[
                    "status"=>"error",
                    "message"=>"New password and confirm password doesn't match."
                ];
            }
        }

        return response()->json($this->return);
    }

    public function alluser()
    {
        $data = User::all();
        $model2 = new User();
        return view('Frontend.User.index', ['user'=>$data, 'model2'=>$model2]);
    }

    public function edit($id)
    {
        $model = User::find($id);
        return view('Frontend.User.registration',['model'=>$model]);
       
    }

    public function store2(request $request){
        Validator::make($request->all(), [
            'username' => 'required|min:5',
            'firstname' => 'required|min:5',
            'lastname' => 'required|min:5',
            'email' => 'required|min:5',
            'password' => 'required|min:5',
            'role' => 'required'
        ]);

        $model = new User;
        $model->name = $request->username;
        $model->first_name = $request->firstname;
        $model->last_name = $request->lastname;
        $model->email = $request->email;
        $model->password = bcrypt($request->password);
        $model->role = $request->role;
        $model->save();

        return redirect ('user-permission');
    }

    public function changeStatus($id, $status='')
    {
        User::find($id)->update(['status'=>$status]);
        return redirect('all-user');
    }

}
