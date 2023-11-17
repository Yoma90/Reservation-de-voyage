@extends('layouts.user_type.auth')

@section('content')
    <!-- Modal for add Product -->
    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Add a new product</h5>
                </div>
                <div class="modal-body">
                    <form action="/create-product" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Regular price</label>
                            <input type="number" class="form-control" id="prregular_priceice" name="regular_price"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Short description</label>
                            <textarea name="short_description" class="form-control" id="short_description" cols="30" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Categories</label>
                            <input type="text" class="form-control" id="categories" name="categories[]" required
                                placeholder="Enter a category">
                            <button type="button" class="btn btn-primary" onclick="addCategory()">Add Category</button>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Images</label>
                            <input type="file" name="images[]" multiple required>
                            <button type="button" class="btn btn-primary" onclick="addImage()">Add image</button>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-primary">Add</button>
                        </div>

                        <script>
                            function addCategory() {
                                const input = document.createElement('input');
                                input.type = 'text';
                                input.className = 'form-control mt-2';
                                input.name = 'categories[]';
                                input.placeholder = 'Enter a category';

                                const addButton = document.querySelector('button');
                                addButton.parentNode.insertBefore(input, addButton);
                            }
                        </script>

                        <script>
                            function addImage() {
                                const input = document.createElement('input');
                                input.type = 'file';
                                input.className = 'form-control mt-2';
                                input.name = 'images[]';
                                input.placeholder = 'Upload an image';

                                const addButton = document.querySelector('button');
                                addButton.parentNode.insertBefore(input, addButton);
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- all --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all-tabs-simple" role="tabpanel" aria-labelledby="all-tabs-simple-tab">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <div class="card-header" pb-0>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <h5 class="mb-0">All Products</h5>
                                        </div>
                                        @if (auth()->user()->role_id == 2)
                                            <div class="d-flex">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn bg-gradient-success btn-block mb-3"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                                    +&nbsp; New product
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Regular Price
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Categories
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($woocommerceProducts as $woocommerceProduct)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['id']))
                                                    {{ $woocommerceProduct['id'] }}
                                                @else
                                                    ID Not Available
                                                @endif
                                            </p>
                                        </td>

                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['name']))
                                                    {{ $woocommerceProduct['name'] }}
                                                @else
                                                    NAME not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['images'][0]))
                                                    <img src="{{ $woocommerceProduct['images'][0]['src'] }}"
                                                        alt="Product Image" width="50" height="50">
                                                @else
                                                    IMAGE not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['type']))
                                                    {{ $woocommerceProduct['type'] }}
                                                @else
                                                    TYPE not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['regular_price']))
                                                    {{ $woocommerceProduct['regular_price'] }} €
                                                @else
                                                    REGULAR PRICE not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['status']))
                                                    {{ $woocommerceProduct['status'] }}
                                                @else
                                                    STATUS not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['categories']))
                                                    {{ substr($woocommerceProduct['categories'], 10) }}
                                                @else
                                                    CATEGORIES not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['date_created']))
                                                    {{ $woocommerceProduct['date_created'] }}
                                                @else
                                                    CREATED DATE not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <span>
                                                <a data-bs-original-title="more details" data-bs-toggle="tooltip"
                                                    href="/product-details/{{ $woocommerceProduct['id'] }}">
                                                    <i class="cursor-pointer fas fa-eye text-secondary"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
