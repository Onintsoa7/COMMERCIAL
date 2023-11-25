<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demande_proformat extends Model
{
    use HasFactory;
    protected $table = 'demande_proforma';
    protected $primaryKey = 'id_proforma';
    public $timestamps = false;
    protected $fillable = [
        'id_proforma',
        'duree_livraison',
        'fk_payement',
        'date_demande',
        'type_livraison',
        'semaine',
        'mois',
        'annee'
    ];
}
