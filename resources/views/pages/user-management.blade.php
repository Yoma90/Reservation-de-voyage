@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <div class="col-md-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalMessage">
                                    +&nbsp; New user
                                </button>

                                <!-- Modal for add agency-->
                                <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="mb-0">new new</h5>
                                            </div>
                                            <div class="modal-body">

                                                <form action="/add-user" method="POST" accept="image/*"
                                                enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">First
                                                            Name</label>
                                                        <input type="text" class="form-control" id="first-name"
                                                            name="first_name" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Last Name</label>
                                                        <input type="text" class="form-control" id="last-name"
                                                            name="last_name" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Phone</label>
                                                        <input type="number" class="form-control" id="phone"
                                                            name="phone" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Agency</label>
                                                        <select class="form-control" id="agency_id" name="agency_id"
                                                            required>
                                                            <option></option>
                                                            @foreach ($agencies as $agency)
                                                                <option value="{{ $agency->id }}">
                                                                    {{ $agency->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Image</label>
                                                        <div class="image-preview" id="imagePreview">
                                                            <img src="" alt="Image Preview" id="previewImage"
                                                                width="300" height="200">
                                                            <span class="close-button" id="closeButton">&#10006;</span>
                                                        </div>

                                                        <input type="file" class="form-control" id="imageInput"
                                                            placeholder="User image" name="image" required>

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
                                            First Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Last Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Agency
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
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->id }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->first_name }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->last_name }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $user->image_path }}" width="100" class="rounded-3">
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->email }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->phone }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->role->name }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->agency->name }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $user->created_at }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($user->status === 'active')
                                                    <a href="/user-status/{{ $user->id }}/suspended" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="suspend user">
                                                        <i class="fas fa-stop"></i>
                                                    </a>
                                                @else
                                                    <a href="/user-status/{{ $user->id }}/active" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="activate user"><i
                                                            class="fas fa-solid fa-check"></i>
                                                    </a>
                                                @endif
                                                <span>
                                                    <a class="mx-3" data-bs-toggle="tooltip"
                                                        href="/delete-user/{{ $user->id }}"
                                                        data-bs-original-title="delete user">
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
