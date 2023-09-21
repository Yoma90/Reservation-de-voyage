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

                                <!-- Modal for take city-->
                                <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="mb-0">new city</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/take-city" method="POST">
                                                    @csrf
                                                    <input type="text" name="name" required class="form-control">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Name</label>
                                                        <select name="ville_id" class="form-control" id="" required>
                                                            <option></option>
                                                            @foreach ($villes as $ville)
                                                                <option value="{{ $ville->id }}">{{ $ville->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn bg-gradient-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                    {{ $city->ville->name }}
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
                                                    <a class="mx-3" data-bs-toggle="tooltip"
                                                        href="/delete-ville-agency/{{$city->id}}"
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
