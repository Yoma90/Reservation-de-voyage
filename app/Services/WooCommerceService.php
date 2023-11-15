<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class WooCommerceService
{
    protected $baseUrl;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->baseUrl = 'https://test.edulearnia.com/wp-json/wc/v3/';
        $this->apiKey = 'ck_90aa2fd7bb5ad01e49afe0254fa2a2e94a05bdfc';
        $this->apiSecret = 'cs_59a2b3cb342b50da827fe47a5c4742a230610494';
    }


    public function getProducts()
    {
        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->get($this->baseUrl . 'products');

        return $response->json();
    }
    public function getProduct($id)
    {
        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->get($this->baseUrl . "products/$id");

        return $response->json();
    }
}


// $woocommerce = new Client(
//     'https://test.edulearnia.com/',
//     $apiKey,
//     $apiSecret,
//     [
//         'version' => 'w3/v3',
//     ]
// );

// $data = [
//     'name' => 'Apple',
//     'type' => 'simple',
//     'regular_price' => '288.99',
//     'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
//     'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
//     'categories' => [
//         [
//             'id' => 9
//         ],
//         [
//             'id' => 14
//         ]
//     ],
//     'images' => [
//         [
//             'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
//         ],
//         [
//             'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
//         ]
//     ]
// ];

// print_r($woocommerce->post('products', $data));


