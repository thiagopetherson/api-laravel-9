<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Helpers\ProductHelper;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','value','active','store_id'];   
    public $timestamps = true;
    protected $table = "products";

    /**
     * Get the product's value.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */

    // Mutator
    protected function value(): Attribute {
        return Attribute::make(
            get: fn ($value) => ProductHelper::formatValue($value),
        );
    }
    
    // Relacionamento com Store
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
