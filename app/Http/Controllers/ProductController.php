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

        // dd($woocommerceProducts);

        return view('pages.product-management')->with('woocommerceProducts', $woocommerceProducts);
    }

    public function showProduct($productId)
    {

        $woocommerceProductImage = $this->wooCommerceService->getProductImage($productId);
        // dd($woocommerceProductImage);

        return view('pages.product-management')->with('woocommerceProductImage', $woocommerceProductImage);
    }
}
