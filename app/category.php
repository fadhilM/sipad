<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    protected $primaryKey ='id_category';
    public $timestamps = false;
    

    protected $fillable = [
        'nama_kategori'
    ];

    public function surat()
    {
        return $this->hasMany('App\surat', 'id_category');
    }
}
