<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hak_akses extends Model
{
    protected $table = 'hak_akses';
    protected $primaryKey = 'id_hak_akses';
    public $timestamps = FALSE;

    public function users(){
        return $this->hasMany('App\User','id_hak_akses','id_hak_akses');
    }
}
