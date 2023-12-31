@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Agencies</h5>
                            </div>
                            <div class="col-md-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalMessage">
                                    +&nbsp; New Agency
                                </button>

                                <!-- Modal for add agency-->
                                <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="mb-0">New Agency</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/add-agency" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Ville</label>
                                                        <select class="form-control" id="ville_id" name="ville_id"
                                                            required>
                                                            <option></option>
                                                            @foreach ($villes as $ville)
                                                                <option value="{{ $ville->id }}">
                                                                    {{ $ville->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Location</label>
                                                        <input type="text" class="form-control" id="location"
                                                            name="location" required>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn bg-gradient-primary">Add</button>
                                                    </div>
                                                </form>
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
                                                Name
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Manager
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
                                        @foreach ($agencies as $agency)
                                            <tr>
                                                <td class="ps-4">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $agency->id }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $agency->name }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if (isset($agency->user))
                                                            {{ $agency->user->last_name }}
                                                        @else
                                                            No Manager attributed
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $agency->status }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-secondary text-xs font-weight-bold">
                                                        {{ $agency->created_at }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    @if ($agency->status === 'active')
                                                        <a href="/agency-status/{{ $agency->id }}/suspended"
                                                            class="mx-3" data-bs-toggle="tooltip"
                                                            data-bs-original-title="suspend agency">
                                                            <i class="fas fa-stop"></i>
                                                        </a>
                                                    @else
                                                        <a href="/agency-status/{{ $agency->id }}/active" class="mx-3"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="activate agency">
                                                            <i class="fas fa-solid fa-check"></i>
                                                        </a>
                                                    @endif
                                                    <span>
                                                        <a class="mx-3" data-bs-toggle="tooltip"
                                                            href="/delete-agency/{{ $agency->id }}"
                                                            data-bs-original-title="delete agency">
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
