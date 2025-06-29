<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'desc')->paginate(10); // paginate instead of get()

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name'           => $request->name,
            'purchase_price' => $request->purchase_price,
            'sell_price'     => $request->sell_price,
            'opening_stock'  => $request->opening_stock,
            'current_stock'  => $request->opening_stock,
        ]);

        return new ProductResource($product);
    }

}
