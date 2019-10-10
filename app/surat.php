<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class surat extends Model
{    
    protected $table = 'surat';
    protected $primaryKey ='id_surat';
    
    protected $fillable = [
        'tujuan','no_surat','dari','untuk','keterangan','dir','id_category','id_user','tipe','filename'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id_user');
    }
    
    public function category()
    {
        return $this->belongsTo('App\category','id_category','id_category');
    }
}
