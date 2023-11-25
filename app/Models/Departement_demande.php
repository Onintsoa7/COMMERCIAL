<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement_demande extends Model
{
    use HasFactory;
    protected $table = 'departement_demande';
    protected $primaryKey = 'id_dept_demande';

    public $timestamps = false;
    
    protected $fillable = ['id_dept_demande','fk_departement', 'date_demande', 'etat'];
}
