<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'codigo',
        'nome',
        'descricao',
        'preco',
        'categoria',
        'quantidade',
        'fornecedor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'fornecedor_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the supplier associated with the product.
     */
    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class, 'id', 'fornecedor_id');
    }
}
