<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma_detail extends Model
{
    protected $table = 'proforma_detail';
    protected $primaryKey = 'id_proforma_detail';

    public $timestamps = false;
    
    use HasFactory;
    protected $fillable = [
        'fk_proforma',
        'fk_article',
        'prix_unitaire',
        'quantite',
    ];
}
