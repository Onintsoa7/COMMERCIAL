<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;
    protected $table = 'proforma';
    protected $primaryKey = 'id_proforma';

    public $timestamps = false;
    
    protected $fillable = [
        'fk_proforma',
        'duree_livraison',
        'date_proforma',
        'fk_fournisseur',
    ];
}
