<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement_user_view extends Model
{
    use HasFactory;
    protected $table = 'departement_user_view';

    public $timestamps = false;
    
    protected $fillable = ['id_user','email', 'password', 'etat', 'id_department', 'nom_departement'];
}
