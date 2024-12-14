<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'cep',
        'logradouro',
        'complemento',
        'bairro',
        'estado',
        'uf',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the products for the supplier.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'fornecedor_id', 'id');
    }

}
