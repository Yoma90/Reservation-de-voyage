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
                    <form action="/add-product" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Regular price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Short description</label>
                            <textarea name="short_description" class="form-control" id="short_description" cols="30" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Categories</label>
                            <input type="number" class="form-control" id="categories" name="categories" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image 1</label>
                            <div class="image-preview" id="imagePreview">
                                <img src="" alt="Image Preview" id="previewImage" width="300" height="200">
                                <span class="close-button" id="closeButton">&#10006;</span>
                            </div>

                            <input type="file" class="form-control" id="imageInput" placeholder="Categorie image"
                                name="image" required>

                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-primary">Add</button>
                        </div>

                        <script>
                            const imageInput = document.getElementById('imageInput');
                            const imagePreview = document.getElementById('imagePreview');
                            const previewImage = document.getElementById('previewImage');
                            const closeButton = document.getElementById('closeButton');

                            closeButton.style.cursor = 'pointer';
                            imageInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (file) {
                                    const reader = new FileReader();

                                    reader.onload = function(e) {
                                        previewImage.src = e.target.result;
                                        imagePreview.style.display = 'block';
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                            closeButton.addEventListener('click', function() {
                                imagePreview.style.display = 'none';
                                imageInput.value = '';
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- View product informations modal --}}
    @foreach ($woocommerceProducts as $woocommerceProduct)
        <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="mb-0">Agency's list</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table align-items-center mb-0">
                            <thead>
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
                                        Buses
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Location
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($woocommerceProducts as $woocommerceProduct)
                                <tbody>
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
                                                    TYPE not available
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
                                                @if (isset($woocommerceProduct['newCategories']))
                                                    {{ substr($woocommerceProduct['newCategories'], 10) }}
                                                @else
                                                    CATEGORIES not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['date_created']))
                                                    {{ $woocommerceProduct['date_created'] }}
                                                @else
                                                    CREATED DATE not available
                                                @endif
                                            </p>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <span>
                                                {{-- <a data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalMessage{{ $woocommerceProduct->id }}"
                                                    data-bs-toggle="tooltip" href="/list-ville/{{ $woocommerceProduct->id }}">
                                                    <i class="cursor-pointer fas fa-pen text-secondary"></i>
                                                </a> --}}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end  --}}


    {{-- all --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all-tabs-simple" role="tabpanel"
            aria-labelledby="all-tabs-simple-tab">
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
                                                    TYPE not available
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
                                                @if (isset($woocommerceProduct['newCategories']))
                                                    {{ substr($woocommerceProduct['newCategories'], 10) }}
                                                @else
                                                    CATEGORIES not available
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if (isset($woocommerceProduct['date_created']))
                                                    {{ $woocommerceProduct['date_created'] }}
                                                @else
                                                    CREATED DATE not available
                                                @endif
                                            </p>
                                            </p>
                                        </td>

                                        <td class="text-center">
                                            <span>
                                                <a
                                                    data-bs-toggle="tooltip" href="/view-product">
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
