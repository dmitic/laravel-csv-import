<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return ProductResource::collection(Product::paginate());
//         ili ako se ne koriste resursi:
//        return response()->json(Product::with('category', 'deparment', 'manufacturer')->paginate());
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
//         ili ako se ne koriste resursi već kastom ApiResponser:
//        return $this->successResponse($product->with('category', 'deparment', 'manufacturer')->first());
    }

    public function update(ProductRequest $request, Product $product)
    {

        $product->fill($request->all());

        if ($product->isClean()){
            return $this->errorResponse('You need to specify a different values to update!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $product->save();

//        return new ProductResource($product);
//        ili ako se ne koriste resursi već kastom ApiResponser:
        return $this->successResponse($product,'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();

//        return new ProductResource($product);
        return $this->successResponse($product,'Product deleted', '200');
    }
}
