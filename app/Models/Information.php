<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'information';

    // client information
    public function my_client()
    {
        return $this->belongsTo('App\Models\Clients', 'client_id');
    }
    // techcian information
    public function my_technician()
    {
        return $this->belongsTo('App\Models\Technician', 'technician_id');
    }
    // type of work information
    public function my_typeofwork()
    {
        return $this->belongsTo('App\Models\Typeofwork', 'typeofwork_id');
    }
    
    protected $fillable = ['status'];

}
