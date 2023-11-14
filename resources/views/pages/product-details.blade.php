@extends('layouts.user_type.auth')

@section('content')
    <style>
        .new-modal {
            display: none;
            position: fixed;
            z-index: 3000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .new-modal-content {
            background-color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border: 1px solid #333;
            border-radius: 5px;
            text-align: center;
        }

        .close {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>

    <div id="newModal" class="new-modal">
        <div class="new-modal-content">
            <span class="close">&times;</span>
            <h2>Paiement</h2>
            <p>En attente de validation sur le numéro <span id="pay_number"></span> </p>
            <p id="paymentMessage"></p>
            <button class="btn btn-primary" id="closeModalBtn">Annuler</button>
        </div>
    </div>


    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h5 class="mb-0 h5">Informations of Product</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row card-body">
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark h6">
                                            ID:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['id']))
                                            {{ $woocommerceProduct['id'] }}
                                        @else
                                            ID not available
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark h6">
                                            Name:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['name']))
                                            {{ $woocommerceProduct['name'] }}
                                        @else
                                            NAME not available
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark h6">
                                            Type:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['type']))
                                            {{ $woocommerceProduct['type'] }}
                                        @else
                                            TYPE not available
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark h6">
                                            Regular price:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['regular_price']))
                                            {{ $woocommerceProduct['regular_price'] }} €
                                        @else
                                            REGULAR PRICE not available
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm text-justify"><strong class="text-dark h6">
                                            Description:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['description']))
                                            {!! $woocommerceProduct['description'] !!}
                                        @else
                                            DESCRIPTION not available
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark h6">
                                            Short description:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['short_description']))
                                            {!! $woocommerceProduct['short_description'] !!}
                                        @else
                                            SHORT DESCRIPTION not available
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark h6">
                                            Categories:</strong> &nbsp;
                                        @if (isset($woocommerceProduct['categories']))
                                            <ul>
                                                @foreach ($woocommerceProduct['categories'] as $category)
                                                    <li>
                                                        {{ $category['name'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            CATEGORIES not available
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-row align-items-center justify-content-center">
                                    <div class="carousel slide" data-ride="carousel">
                                        <!-- Indicators (optional) -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#productCarousel" data-slide-to="0" class="active"></li>
                                            <!-- Add more indicators if you have multiple images -->
                                        </ol>

                                        <!-- Slides -->
                                        <div class="carousel-inner">
                                            @if (isset($woocommerceProduct['images']) && count($woocommerceProduct['images']) > 0)
                                                @foreach ($woocommerceProduct['images'] as $key => $image)
                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                        <img src="{{ $image['src'] }}" alt="Product Image" class="img-fluid" width="500" height="500">
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="carousel-item active">
                                                    <p class="text-danger">IMAGE not available</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Controls (optional) -->
                                        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection




































































{{-- Create a product in WooCommerce using Postman --}}
{{-- curl -x POST https://example.com/wp-json/wc/v2/products
    -u consumer_key:consumer_secret
    -H "Content-type: application/json"
    -d '{
    'name' => 'Premium Quality',
    'type' => 'simple',
    'regular_price' => '21.99',
    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
    'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
    'categories' => [
        [
            'id' => 9
        ],
        [
            'id' => 14
        ]
    ],
    'images' => [
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
        ]
    ]
}' --}}
