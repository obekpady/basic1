<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
use Image;

class BlogController extends Controller
{
    
    public function AllBlog(){
        $blogs = Blog::latest()->get();


        return view('admin.blog.blog_all', compact('blogs'));

    }// end method

    public function AddBlog(){
        $categories=BlogCategory:: orderBy('blog_category', 'ASC')->get();

        return view('admin.blog.blog_add', compact('categories'));
        
    } //end method

    public function StoreBlog(Request $request){

        $request->validate([
            'blog_title'=> 'required',
            'blog_description' => 'required',
            'blog_image' => 'required',
        ], [
            'blog_title.required' => 'Blog Name is required',
            'blog_description.required' => 'Blog Description is required',
            'blog_image.required' => 'Blog Image is required',
        
        ]);

            $image =$request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); //3434363534.jpg
            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;
            
            
            
            Blog::insert([
                'blog_category_id'=> $request->blog_category_id,
                'blog_title'=> $request->blog_title,
                'blog_tags'=> $request->blog_tags,
                'blog_description'=> $request->blog_description,
                'blog_image'=> $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog inserted  successfully',
                'alert-type' => 'success'
            );
        
            return redirect()->route('all.blog')->with($notification);
              
    }
    //
}
