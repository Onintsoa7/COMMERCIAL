<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande_hebdo extends Model
{
    use HasFactory;
    protected $connection = 'pgsql';
    protected $table = 'v_demande_par_semaine';
    //semaine | mois | annee | id_dept_demande | fk_article |        nom        | nom_deparatement | id_departement | quantite | etat
    protected $fillable = [
        'semaine',
        'mois',
        'annee',
        'id_dept_demande',
        'fk_article',
        'nom',
        'nom_deparatement',
        'id_departement',
        'quantite',
        'etat',
        'fk_categorie'
    ];

    public $timestamps = false;
}
