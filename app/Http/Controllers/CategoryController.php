<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
    
        return view('category.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        $this->pr($categories->toArray());
        return view('category.create-category', compact('categories'));       
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'      => 'required',            
            'parent_id' => 'nullable|numeric'
        ]);

        Category::create([
            'name' => $request->name,            
            'parent_id' =>$request->parent_id
        ]);

        return redirect()->back()->with('success', 'Category has been created successfully.');        
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show',compact('category'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();        
        $this->pr($categories->toArray());
        $category_data=$category;
        $this->pr($category_data->toArray());
        return view('category.edit',compact('category_data','categories'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = $request->validate([
            'name'      => 'required',            
            'parent_id' => 'nullable|numeric'
        ]);

        $this->pr($request->all());
        
        //DB::enableQueryLog();
        
        $category->update($request->all());
        //$this->pr(DB::getQueryLog());
          //  exit;

        return redirect()->route('categories.index')
                        ->with('success','category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {       
        $category->delete();    
        return redirect()->route('categories.index')->with('success','Product deleted successfully');
    }
    public function pr($arr)
    {
        echo "<pre>";
        print_R($arr);
        echo "</pre>";
    }
    
}