<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;   
/*
    |--------------------------------------------------------------------------
    | product list with search by category_name
    |--------------------------------------------------------------------------   
    */
class ProductController extends Controller
{
     public function list(Request $request)
    {
        try
        {        
            //DB::enableQueryLog();        
            $category_name=$request->get('category_name');
            $products = Product::with('category')->whereHas('category', function($q) use($category_name){
                    if($category_name!="")
                        $q->where('name', 'like','%'.$category_name.'%');
                    })->get();        
            
            $total=count($products->toArray());

            //pr(DB::getQueryLog());     
          
            return response()->json([
                'data' => $products,
                'status' => 'success',
                'message' => ($total==0?"No":$total)." record(s) found",
            ]);
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }
}
