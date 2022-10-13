<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
use Image;


class BlogCategoryController extends Controller
{

    public function AllBlogCategory(){

        $blogcategory = BlogCategory::latest()->get();


        return view('admin.blog_category.blog_category_all', compact('blogcategory'));
    }// end method

    public function AddBlogCategory(){


        return view('admin.blog_category.blog_category_add');
    }//end method

    public function StoreBlogCategory(Request $request){

        $request->validate([
            'blog_category'=> 'required',
        ], [
            'blog_category.required' => 'Blog Category is required',
            
        ]);

        BlogCategory::insert([
            'blog_category'=> $request->blog_category,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category inserted  successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.blog.category')->with($notification);
    }//end method

    public function EditBlogCategory($id){
        $blogcategory = BlogCategory::findOrFail($id);

        return view('admin.blog_category.blog_category_edit', compact('blogcategory'));


    }//end method

    public function UpdateBlogCategory(Request $request){
        $blog_id = $request->id;
        BlogCategory::findOrFail($blog_id)->update([
            'blog_category'=> $request->blog_category,
        ]);
        $notification = array(
            'message' => 'Blog Category updated successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.blog.category')->with($notification);
    }
    public function DeleteBlogCategory($id){
        //$del = Portfolio::findOrFail($id);
        BlogCategory::findOrFail($id)->delete();
    $notification = array(
    'message' => 'Blog Category deleted successfully',
    'alert-type' => 'success'
);

return redirect()->back()->with($notification);

    }
    
}// end controller
