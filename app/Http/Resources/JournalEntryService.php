<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Journal;
class JournalEntryService
{
    /**
     * Record a sale with stock adjustment.
     *
     * @param  \App\Models\Sale  $sale
     * @return \App\Models\Journal
     */
    public function recordSaleWithStock($sale)
    {
        $journal = Journal::create([
            'type' => 'sale',
        ]);

        $total = $sale->unit_price * $sale->quantity;
        $afterDiscount = $total - $sale->discount;
        $vat = ($sale->vat_rate / 100) * $afterDiscount;
        $due = $afterDiscount + $vat - $sale->paid;

        // Accounting entries
        $journal->entries()->createMany([
            ['account_name' => 'Cash',           'debit' => $sale->paid],
            ['account_name' => 'Sales Revenue',  'credit' => $afterDiscount],
            ['account_name' => 'Discount Given', 'debit' => $sale->discount],
            ['account_name' => 'VAT Payable',    'credit' => $vat],
            ['account_name' => 'Accounts Receivable', 'debit' => $due],
            ['account_name' => 'Inventory',      'credit' => $sale->quantity * $sale->product->purchase_price],
           
        ]);

        $sale->journal_id = $journal->id;
        $sale->save();

        return $journal;
    }

}
