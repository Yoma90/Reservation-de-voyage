<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\WooCommerceService;
use Illuminate\Http\Request;

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
            $value["newCategories"] = $this->changeArrayToString($value["categories"]);
            array_push($products, $value);
        }

        return view('pages.product-management')->with('woocommerceProducts', $products);
    }

    // public function showProduct($productId)
    // {

    //     $woocommerceProductImage = $this->wooCommerceService->getProductImage($productId);
    //     // dd($woocommerceProductImage);

    //     return view('pages.product-management')->with('woocommerceProductImage', $woocommerceProductImage);
    // }

    public function changeArrayToString($array){
        $str = "";
        foreach ($array as $value) {
            $str = $str.",".$value['name'];
        }
        return $str;
    }


}
