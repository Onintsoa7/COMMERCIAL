<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie_article_view extends Model
{
    use HasFactory;
    protected $table = 'categorie_article_view';

    public $timestamps = false;
    
    protected $fillable = ['id_article','nom_article','id_categorie','nom_categorie'];
}
