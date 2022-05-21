<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show listing of product
    |--------------------------------------------------------------------------   
    */
    public function index()
    {
        try 
        {           
            $products = Product::with("category")->latest()->paginate(5);

            return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        }    
    }

    /*
    |--------------------------------------------------------------------------
    | Show create product form
    |--------------------------------------------------------------------------   
    */
    public function create()
    {
        try
        {        
            $categories = Category::where('category_id', null)->orderby('name', 'asc')->get();           
            return view('products.create',compact('categories'));
        }
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }

     /*
    |--------------------------------------------------------------------------
    | Store product into DB
    |--------------------------------------------------------------------------   
    */
    public function store(Request $request)
    {
        try
        {
            $request->validate([
                'name' => 'required',
                'description' => 'required',            
                'category_id' => 'required'
            ]);

            Product::create($request->all());

            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        }
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }   

   /*
    |--------------------------------------------------------------------------
    | Show edit form
    |--------------------------------------------------------------------------   
    */
    public function edit(Product $product)
    {
        try
        {
            $categories = Category::where('category_id', null)->orderby('name', 'asc')->get();        
            return view('products.edit', compact('product','categories'));
        }
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }
    /*
    |--------------------------------------------------------------------------
    | Update product
    |--------------------------------------------------------------------------   
    */
    public function update(Request $request, Product $product)
    {
        try
        {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'description' => 'required',            
            ]);
            $product->update($request->all());

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        }
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }
    /*
    |--------------------------------------------------------------------------
    | Delete product
    |--------------------------------------------------------------------------   
    */
    public function destroy(Product $product)
    {
        try
        {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }
    
}

