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
        // dd($request);
        $attributes = $request->validate([
            'name' => '',
            'regular_price' => '',
            'description' => '',
            'short_description' => '',
            'categories.*' => '',
            'images.*' => ''
        ]);


        $categoryIds = $attributes['categories'];
        $categories = [];
        foreach ($categoryIds as $categoryId) {
            $categories[] = ['id' => $categoryId];
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName);
                $images[] = ['src' => url('storage/images/' . $imageName)];
            }
        }

        $attributes['images'] =
            [
                [
                    'src' => 'https://veroniquecloutier.com/famille/votre-chien-sennuie-t-il'
                ],
                [
                    'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
                ]
            ];
        $attributes['type'] = "simple";
        $attributes['categories'] = [
            [
                'id' => 9
            ],
            [
                'id' => 14
            ]
        ];


        // dd($attributes);
        $woocommerceProductRes = $this->wooCommerceService->createProduct($attributes);


        if ($woocommerceProductRes) {
            return redirect()->back()->with('success', 'Product created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create product. Please try again.');
        }


        return redirect()->back()->with('success', 'Product created successfully');
    }
}
