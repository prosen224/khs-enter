<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateCode(){
        $vCode = mt_rand(1000 ,9999);
        return $vCode;
    }
    public function updateRole($id){
        $query = self::findOrFail($id);
        if($query){
            $query->role = "1";
            $query->verify_code = null;
            return $query->save();
        }
    }

    function sendVerificationMail($id)
    {
        $user_info = self::findOrFail($id);
        $link = env('APP_URL')."/verify-email";
        $code = encrypt($user_info->verify_code);
        $data = [
            "link"=> $link."?vef=".$code,
            "body_text"=>"verify your E-mail.",
            "button_text"=>"Verify E-mail"
        ];

        \Mail::send('mail', $data, function($message) use ($user_info) {
            $message->to($user_info->email, $user_info->name)->subject('Your E-mail varification link - '.env("APP_NAME"));
            $message->from(env("MAIL_USERNAME"), env('APP_NAME'));
        });

    }

    function sendForgotPasswordMail($id)
    {
        $user_info = self::findOrFail($id);
        $link = env('APP_URL')."/set-password";
        $code = encrypt($user_info->id);
        $data = [
            "link"=> $link."?sp=".$code,
            "body_text"=>"reset your password.",
            "button_text"=>"Reset Password"
        ];

        \Mail::send('mail', $data, function($message) use ($user_info) {
            $message->to($user_info->email, $user_info->name)->subject('Your set password link - '.env("APP_NAME"));
            $message->from(env("MAIL_USERNAME"), env('APP_NAME'));
        });

    }
    public $userroles = 
    [
        1=> "Admin",
        2=> "Super Admin",
        3=> "Regular"
    ];
}
