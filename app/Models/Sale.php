<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'unit_price', 'discount', 'vat_rate', 'paid'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //Sale belongs to a Journal
    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

}
