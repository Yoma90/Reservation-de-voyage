<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Automattic\WooCommerce\Client;

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

    public function createProduct($input)
    {

        $woocommerce = new Client(
            'https://test.edulearnia.com/',
            'ck_90aa2fd7bb5ad01e49afe0254fa2a2e94a05bdfc',
            'cs_59a2b3cb342b50da827fe47a5c4742a230610494',
            [
                'wp_api' => true,
                'version' => 'wc/v3'
            ]
        );
        $response = $woocommerce->post('products', $input);
        return $response;
    }
}
