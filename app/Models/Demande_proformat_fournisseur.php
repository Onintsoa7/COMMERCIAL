<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande_proformat_fournisseur extends Model
{
    use HasFactory;
    protected $table = 'demande_proforma_fournisseur';
    protected $primaryKey = null;
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'fk_proforma',
        'fk_categorie',
        'fk_fournisseur', 
    ];
}
