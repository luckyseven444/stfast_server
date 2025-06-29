<?php 
namespace App\Http\Controllers\Api;

use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Resources\JournalEntryService;
use App\Http\Resources\SaleResource;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function store(SaleRequest $request, JournalEntryService $journalService)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($validated['product_id']);

            if ($product->currentStock() < $validated['quantity']) {
                return response()->json(['error' => 'Not enough stock'], 422);
            }

            $sale = Sale::create($validated);

            $journalService->recordSaleWithStock($sale);

            DB::commit();

            return new SaleResource($sale);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Sale failed',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

}


