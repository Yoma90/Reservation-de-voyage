<?php

namespace App\Services;

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

    public function getProductImage($productId)
    {
        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->get($this->baseUrl . 'products/' . $productId);

        $productData = $response->json();
        $imageUrl = $productData['images'][0]['src'] ?? null;

        return $imageUrl;
    }
}
