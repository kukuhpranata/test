<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Validator;

class ProductController extends Controller
{


    public function showProduct()
    {
        $product =  Product::all();
        return response()->json([
            'error'=>false,
            'data' =>$product,

        ]);
    }

    public function showDetail($id)
    {
        $product =  Product::find($id);
        return response()->json([
            'error'=>false,
            'data' =>$product,

        ]);
    }


    public function addCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            '_id' => 'required',
            'category_name' => 'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $category = Category::create(array_merge(
                    $validator->validated(),
                ));

        return response()->json([
            'message' => 'Category successfully registered',

        ], 201);
    }
    

    public function addProduct(Request $request) {
        $validator = Validator::make($request->all(), [
            '_id'=> 'required',
            'product_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $product = Product::create(array_merge(
                    $validator->validated(),
                ));

        return response()->json([
            // 'message' => 'Product successfully added',
            // 'product' => $product,
            'error' => false,
            'success' => true

        ], 201);
    }

    public function destroyProduct($id) {

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        if ($product->delete()) {
            return response()->json([
                'error' => false,
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted'
            ], 500);
        }

    }

    public function updateProduct(Request $request, $id) {
        $product = Product::find($id);
        
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $product->update(array_merge(
                    $validator->validated(),
                ));

        return response()->json([
            'error' => false,
            'success' => true

        ], 201);
    }
}
