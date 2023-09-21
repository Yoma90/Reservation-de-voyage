@extends('layouts.user_type.auth')

@section('content')
    <!-- Modal for add Travel -->
    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Add a new Trip</h5>
                </div>
                <div class="modal-body">
                    <form action="/add-travel" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">From</label>
                            <select name="from" class="form-control" id="" required>
                                <option></option>
                                @foreach (auth()->user()->agency->agency_ville as $ville)
                                    <option value="{{ $ville->ville_id }}">{{ $ville->ville->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">To</label>
                            <select name="to" class="form-control" id="" required>
                                <option></option>
                                @foreach (auth()->user()->agency->agency_ville as $ville)
                                    <option value="{{ $ville->ville_id }}">{{ $ville->ville->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Details</label>
                            <textarea name="details" class="form-control" id="details" cols="30" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-primary">Add</button>
                        </div>
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
                                            <h5 class="mb-0">All Travels</h5>
                                        </div>
                                        @if (auth()->user()->role_id == 2)
                                            <div class="d-flex">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn bg-gradient-success btn-block mb-3"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                                    +&nbsp; New Travel
                                                </button>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        From
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        To
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Details
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price
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
                                @foreach ($travels as $travel)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $travel->id }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $travel->from }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $travel->to }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $travel->details }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $travel->price }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $travel->created_at }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            @if ($travel->status === 'active')
                                                <a href="/travel-status/{{ $travel->id }}/suspended" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="suspend travel">
                                                    <i class="fas fa-stop"></i>
                                                </a>
                                            @else
                                                <a href="/travel-status/{{ $travel->id }}/active" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="activate travel"><i
                                                        class="fas fa-solid fa-check"></i>
                                                </a>
                                            @endif
                                            <span>
                                                <a class="mx-3" data-bs-toggle="tooltip"
                                                    href="/delete-travel/{{ $travel->id }}"
                                                    data-bs-original-title="delete travel">
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
    {{-- </div> --}}
@endsection
