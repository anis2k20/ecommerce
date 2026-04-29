<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy("id","desc")->paginate(10);

        $products->getCollection()->transform(function($product){
            $product->image_url = $product->image ? Storage::url($product->image) : null;
            return $product;
        });

        return Inertia::render('Admin/Products', [
            'products' => $products
        ]);
    }

    public function publicIndex(){
        $products = Product::with('category')->orderBy('id','desc')->paginate(10);

        $products->getCollection()->transform(function($product){
            $product->image_url = $product->image ? Storage::url($product->image) : null;
            return $product;
        });

        return Inertia::render('Products', ['products' => $products])
            ->withViewData(['layout' => 'layouts.FrontendLayout']);

    }

    public function create(){
        return Inertia::render('Admin/ProductCreate', [
            'categories' => Category::all()->map(function($category){
                return [
                    'id'=> $category->id,
                    'name'=> $category->name
                ];
            })
        ]);
    }

    public function store(Request $request){
    //      dd([
    //     'hasFile' => $request->hasFile('image'),
    //     'file' => $request->file('image'),
    //     'input' => $request->input('image'),
    //     'all_files' => $request->allFiles(),
    //     'content_type' => $request->header('Content-Type'),
    // ]);
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image'=> 'nullable|file|image|max:2048'
            
        ]);

        // handle image upload
        if($request->hasFile('image')){
            $request->validate([
                'image'=> 'nullable|file|image|max:2048'
                ]);
        }
        
        $imageUrl = null;
   if($request->hasFile('image') && $request->file('image')->isValid()){
           $imageUrl = $request->file('image')->store('products', 'public');
        }


        Product::create([
            'name'=> $request->name,
            'slug'=> $request->slug,
            'price'=> $request->price,
            'description'=> $request->description,
            'category_id'=> $request->category_id,
            'image'=> $imageUrl

        ]);

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }
}
