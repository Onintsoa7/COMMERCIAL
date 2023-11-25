<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $table = 'fournisseur';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id_fournisseur';

    // Define the fillable columns
    protected $fillable = [
        'nom', 'email', 'telephone', 'adresse'
    ];
}
