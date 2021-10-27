<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSanguineo extends Model
{
    //

    protected $table = "tipo_sanguineo";
    public $incrementing = false;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'descricao',
    ];

    protected $hidden = [];


    public function paciente()
    {
        return $this->hasOne('App\paciente', 'id_tipo_sanguineo','id');
    }

}
