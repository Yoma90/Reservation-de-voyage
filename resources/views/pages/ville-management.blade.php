@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Cities</h5>
                            </div>
                            <div class="col-md-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalMessage">
                                    +&nbsp; New City
                                </button>

                                <!-- Modal for add city-->
                                <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="mb-0">new city</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/add-city" method="POST" accept="image/*"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>width="300" height="300"
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Image</label>
                                                        <div class="image-preview" id="imagePreview">
                                                            <img src="" alt="Image Preview" id="previewImage"
                                                                width="300" height="200">
                                                            <span class="close-button" id="closeButton">&#10006;</span>
                                                        </div>

                                                        <input type="file" class="form-control" id="imageInput"
                                                            placeholder="Categorie image" name="image" required>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Descrition</label>
                                                        <textarea name="description" id="description" class="form-control" required cols="30" rows="5"></textarea>
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
                                {{-- end  --}}


                                {{-- List agency modal --}}
                                @foreach ($cities as $city)
                                    <div class="modal fade" id="exampleModalMessage{{ $city->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="mb-0">Agency's list</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table align-items-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                        @foreach ($city->agency_ville as $agency_ville)
                                                            <tbody>
                                                                <tr>
                                                                    <td class="ps-4">
                                                                        <p class="text-xs font-weight-bold mb-0">
                                                                            {{ $agency_ville->id }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <p class="text-xs font-weight-bold mb-0">
                                                                            {{ $agency_ville->agency->name }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <p class="text-xs font-weight-bold mb-0">
                                                                            {{ count($agency_ville->agency->bus) }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <p class="text-xs font-weight-bold mb-0">
                                                                            {{ $agency_ville->location }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <p class="text-xs font-weight-bold mb-0">
                                                                            {{ $agency_ville->agency->status }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span
                                                                            class="text-secondary text-xs font-weight-bold">
                                                                            {{ $agency_ville->created_at }}
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
                            </div>
                        </div>
                    </div>


                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
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
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $city->id }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $city->name }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $city->image_path }}" width="100" class="rounded-3">
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $city->description }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $city->status }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $city->created_at }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($city->status === 'active')
                                                    <a href="/city-status/{{ $city->id }}/suspended" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="suspend city">
                                                        <i class="fas fa-stop"></i>
                                                    </a>
                                                @else
                                                    <a href="/city-status/{{ $city->id }}/active" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="activate city"><i
                                                            class="fas fa-solid fa-check"></i>
                                                    </a>
                                                @endif
                                                <span>
                                                    {{-- <a class="mx-3" data-bs-toggle="tooltip"
                                                        href="list-agencies"
                                                        data-bs-original-title="view agencies">
                                                        <i class="cursor-pointer fas fa-eye text-secondary"></i>
                                                    </a> --}}
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalMessage{{ $city->id }}"
                                                        data-bs-toggle="tooltip" href="/list-ville/{{ $city->id }}">
                                                        <i class="cursor-pointer fas fa-eye text-secondary"></i>
                                                    </a>
                                                </span>
                                                <span>
                                                    <a class="mx-3" data-bs-toggle="tooltip"
                                                        href="/delete-city/{{ $city->id }}"
                                                        data-bs-original-title="delete city">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
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
    </div>
@endsection
