<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show listing of category
    |--------------------------------------------------------------------------   
    */
    public function index()
    {
        try
        {
            $categories = Category::latest()->paginate(5);        
            return view('category.index',compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        } 
    }
     
   /*
    |--------------------------------------------------------------------------
    | Show create category form
    |--------------------------------------------------------------------------   
    */
    public function create()
    {
        try
        {
            $categories = Category::where('category_id', null)->orderby('name', 'asc')->get();       
            return view('category.create', compact('categories'));       
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        }         
    }
    
    /*
    |--------------------------------------------------------------------------
    | Store category into DB
    |--------------------------------------------------------------------------   
    */
    public function store(Request $request)
    {
        try
        {
            $validator = $request->validate([
                'name'      => 'required',            
                'category_id' => 'nullable|numeric'
            ]);

            Category::create([
                'name' => $request->name,            
                'category_id' =>$request->category_id
            ]);

             return redirect()->route('categories.index')->with('success', 'Category created successfully.');
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
    public function edit(Category $category)
    {
        try
        {
            $categories = Category::where('category_id', null)->orderby('name', 'asc')->get();        
            $category_data=$category;

            return view('category.edit',compact('category_data','categories'));
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Update category
    |--------------------------------------------------------------------------   
    */
    public function update(Request $request, Category $category)
    {
        try
        {
            $validator = $request->validate([
                'name'      => 'required',            
                'category_id' => 'nullable|numeric'
            ]);            
            
            $category->update($request->all());
            return redirect()->route('categories.index')->with('success','category updated successfully');
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        }
    }
    
     /*
    |--------------------------------------------------------------------------
    | Delete category
    |--------------------------------------------------------------------------   
    */
    public function destroy(Category $category)
    {       
        try
        {
            $category->delete();    
            return redirect()->route('categories.index')->with('success','Product deleted successfully');
        } 
        catch (\Exception $e) 
        {
            pr($e->getMessage());
            exit;           
        }
    }   
    
}