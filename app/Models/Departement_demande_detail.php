<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement_demande_detail extends Model
{
    use HasFactory;
    protected $table = 'departement_demande_detail';
    protected $primaryKey = 'id_dept_demande_detail';

    public $timestamps = false;
    
    protected $fillable = ['id_dept_demande_detail','fk_dept_demande', 'fk_article', 'quantite'];
}
