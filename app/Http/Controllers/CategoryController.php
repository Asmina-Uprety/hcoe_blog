<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        // return $categories;
        return view('admin.category.index',compact('categories'));
    }

    /**  
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation 

        // return $request;

        $category = new Category();

        //Category::create($request->all()) 
        //DB::table('categories') .......  
        
        $category->name = $request->name;

        // str_slug($category->name)
        $category->slug = Str::slug($request->name);

        $imageName = time().'.'.$request->featured_image->getClientOriginalExtension(); 

        $request->featured_image->move(public_path('images'), $imageName);

        $category->featured_image = $imageName;

        $category->description = $request->description;

        $category->show_on_menu_page = ($request->has('show_on_menu_page'))?1:0;



        $category->save();

        return redirect()->route('categories.index')->withStatus('Category added');
  


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $category = new Category();

        //Category::create($request->all()) 
        //DB::table('categories') .......  
        
        $category->name = $request->name;

        // str_slug($category->name)
        $category->slug = Str::slug($request->name);


        if($request->has('featured_image')){

            $imageName = time().'.'.$request->featured_image->getClientOriginalExtension(); 

            $request->featured_image->move(public_path('images'), $imageName);

            $category->featured_image = $imageName;
        }
        $category->description = $request->description;

        $category->show_on_menu_page = ($request->has('show_on_menu_page'))?1:0;



        $category->save();

        return redirect()->route('categories.index')->withStatus('Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // return $category;
        unlink(public_path('/images/'.$category->featured_image));
        $category->delete();
        return redirect()->route('categories.index')->withStatus('Category deleted');

    }

    public function complete($id)
    {
        // return $id;

        $category = Category::find($id);
        if( $category->show_on_menu_page == 0 ){
            $category->show_on_menu_page = 1;
        }
        else
        {
            $category->show_on_menu_page = 0;
        }

        $category->save();
        // return redirect()->back();

        return $category->id;

    }
}
