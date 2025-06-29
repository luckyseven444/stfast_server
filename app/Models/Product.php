<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $fillable = [
        'name', 
        'purchase_price', 
        'sell_price', 
        'opening_stock', 
        'current_stock'
    ];
    
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    
    public function currentStock()
    {
        $sold = $this->sales()->sum('quantity');
        return $this->opening_stock - $sold;
    }

}
