<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name','email'];
    public $timestamps = true;
    protected $table = "stores";

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

    // Relacionamento com Product
    public function products(){
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
}
