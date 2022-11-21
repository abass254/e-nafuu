<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use DB;

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
    public function storeBrands(Request $req){
        if($req->id){
           // return $req->all();
            DB::table('brands')->where('id', $req->id)->update([
                'title' => $req->title,
                'description' => $req->description,
                'photo' => $req->photo,
            ]);

            return response()->json([
                'message' => 'Successfully Updated',
                'status' => true
            ]);
        }

        else{
           // return $req->all();
            $br = new Brand();
            $br->uuid = Str::random(30);
            $br->title = $req->title;
            $br->photo = $req->photo;
            $br->status = '1';
            $br->description = $req->description;
            $br->save();

            return response()->json([
                'message' => 'Brand Added Successfully',
                'status' => true
            ]);
        }
    }
}
