<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur_categorie extends Model
{
    use HasFactory;

    protected $table = 'v_fournisseur_categorie';
    public $timestamps = false;
    protected $fillable = [
       'id_fournisseur', 'nom_fournisseur', 'email', 'telephone', 'adresse', 'id_categorie', 'nom'
    ];
}
