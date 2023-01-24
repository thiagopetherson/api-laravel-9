<?php

namespace App\Models;

use DateTimeInterface;
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
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
    */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
