<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre']; // Declaro que campos voy a mostrar de mi modelo

    //Relación de uno a mucho con Productos
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}
