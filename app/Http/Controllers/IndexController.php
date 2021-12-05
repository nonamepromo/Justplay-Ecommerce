<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index(){
        $productsFeature = Product::inRandomOrder()->where('feature_item',1)->paginate(10);
        $productsAll = Product::inRandomOrder()->paginate(50);
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //Meta Tags
        $meta_title = "Justplay";
        $meta_description = "Negozio online per videogiochi";
        $meta_keywords = "eshop website, online shopping, videogames, console, playstation";

        return view('index')->with(compact('productsFeature','productsAll', 'categories',
            'meta_title','meta_description','meta_keywords'));
    }
}
