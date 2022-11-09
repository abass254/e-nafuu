<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class CoreController extends Controller
{
    //Category Functionalities
    public function getCategories(){
        $categories = Category::all();
        return $categories;
        //return view('category.list', compact('categories'));
    }

    public function createCategory()
    {
       // $categories =
    }

    public function saveCategory(Request $req)
    {
        $category = $this->getCategoryById($req->category);
        if(count($category) > 1){
            return 'Data exists';
        }

        else{
            return 'Data does not exists';
        }
    }

    public function getCategoryById($id)
    {
        $category = Category::where('id', $id)->get();
        return $category;
    }

    public function getBrands(){
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }
}
