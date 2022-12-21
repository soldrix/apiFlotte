<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voiture extends Model
{
    use HasFactory;

    protected $table = 'voitures';

    protected $primaryKey = 'id';

    protected $fillable =[
        "image",
        "marque",
        "model",
        "statut",
        "puissance",
        "circulation",
        "carburant",
        "puissance",
        "type",
        "nbPorte",
        "nbPlace",
        "immatriculation",
        "prix",
        "id_agence"
    ];
}
