<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB; 

class CategoryController extends Controller
{
     public function list(Request $request)
    {
        DB::enableQueryLog();
        $category_name=$request->get('category_name');

        $category = Category::with('subcategory')->whereHas('subcategory', function($q) use($category_name){
                if($category_name!="")
                    $q->where('name', 'like','%'.$category_name.'%');
                })->get();        
        
        $total=count($category->toArray());

        pr(DB::getQueryLog());     
      
        return response()->json([
            'data' => $category,
            'status' => 'success',
            'message' => ($total==0?"No":$total)." record(s) found",
        ]);
    }
}
