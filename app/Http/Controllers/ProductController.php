<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\WooCommerceService;
use App\Http\Controllers\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('pages.product-management')->with('products', $products);
    }

    protected $wooCommerceService;

    public function __construct(WooCommerceService $wooCommerceService)
    {
        $this->wooCommerceService = $wooCommerceService;
    }

    public function index2()
    {
        $woocommerceProducts = $this->wooCommerceService->getProducts();

        $products = [];

        foreach ($woocommerceProducts as $value) {
            $value["categories"] = $this->changeArrayToString($value["categories"]);
            array_push($products, $value);
        }

        return view('pages.product-management')->with('woocommerceProducts', $products);
    }

    public function changeArrayToString($array)
    {
        $str = "";
        foreach ($array as $value) {
            $str = $str . "," . $value['name'];
        }
        // $str = "hello am MIT what is your name?";
        $newstr = $str;
        if (Str::length($str) > 20) {
            $newstr = Str::substr($str, 0, 20) . "...";
        }
        return $newstr;
    }


    public function viewProduct($id)
    {
        $woocommerceProduct = $this->wooCommerceService->getProduct($id);

        return view('pages.product-details')->with('woocommerceProduct', $woocommerceProduct);
    }


    public function createProduct(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'regular_price' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'categories.*' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        // dd($attributes);

        $categoriesJson = json_encode($attributes['categories']);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName);
                $images[] = $imageName;
            }
        }
        // dd($images);

        $apiResponse = Http::post('https://test.edulearnia.com/wp-json/wc/v3/products', [
            'name' => $attributes['name'],
            'type' => $attributes['type'],
            'regular_price' => $attributes['regular_price'],
            'description' => $attributes['description'],
            'short_description' => $attributes['short_description'],
            'categories' => $categoriesJson,
            'images' => $images
        ]);

        // $this->wooCommerceService->syncProduct($product);
        dd($apiResponse);

        if ($apiResponse->successful()) {
            return redirect()->back()->with('success', 'Product created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create product. Please try again.');
        }


        return redirect()->back()->with('success', 'Product created successfully');
    }
}
