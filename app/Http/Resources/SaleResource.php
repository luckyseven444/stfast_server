<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'product'   => $this->product->name ?? null,
            'quantity'  => $this->quantity,
            'unit_price'=> $this->unit_price,
            'discount'  => $this->discount,
            'vat_rate'  => $this->vat_rate,
            'paid'      => $this->paid,
            'created_at'=> $this->created_at,
            'journal'   => JournalResource::make($this->journal),
        ];
    }
}
