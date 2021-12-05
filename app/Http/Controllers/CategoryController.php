<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if(Session::get('adminDetails')['categories_full_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['meta_title'])){
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->url = $data['url'];
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success','Category added Successfully!');
        }

        $levels = Category::where(['parent_id'=>0])->get();

        return view('admin.categories.add_category')->with(compact('levels'));
    }

    public function editCategory(Request $request, $id = null){
        if(Session::get('adminDetails')['categories_edit_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['meta_title'])){
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }
            if(empty($data['description'])){
                $data['description']='';
            }

            Category::where(['id'=>$id])->update(['parent_id'=>$data['parent_id'],
                'name'=>$data['category_name'],'description'=>$data['description'],
                'url'=>$data['url'], 'meta_title'=>$data['meta_title'],
                'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords']]);
            return redirect('/admin/view-categories')->with('flash_message_success','Category updated Successfully!');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
    }

    public function viewCategories(Request $request, $id = null){
        if(Session::get('adminDetails')['categories_view_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $categories = Category::get();
        $categories = json_decode(json_encode($categories));
        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    public function deleteCategory(Request $request, $id = null){
        if(Session::get('adminDetails')['categories_full_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if(!empty($id)){
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Category deleted Successfully!');
        }
    }
}
