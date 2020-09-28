<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function allProducts(Category $category)
    {
        return ProductResource::collection($category->products()->paginate());
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());

        if ($category->isClean()){
            return $this->errorResponse('You need to specify a different values to update!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $category->update();

//        return new CategoryResource($category);
//        ili ako se ne koriste resursi već kastom ApiResponser:
        return $this->successResponse($category,'Category updated');
    }

    public function destroy(Category $category)
    {
        if($category->isEmpty()){
            $category->delete();
//            return response()->json('Category deleted');
            return $this->successResponse($category,'Category deleted', '200');
        }

        return $this->errorResponse('Category can not be deleted while have products assigned!', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
