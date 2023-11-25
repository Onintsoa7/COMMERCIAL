<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liste_demande extends Model
{
    use HasFactory;
    protected $table = 'v_liste_demande';

    protected $fillable = [
        'semaine',
        'mois','annee',
        'id_dept_demande',
        'fk_departement',
        'date_demande ','etat',
    ];

    public $timestamps = false;
}