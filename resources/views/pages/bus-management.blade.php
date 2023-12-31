@extends('layouts.user_type.auth')

@section('content')
    <!-- Modal for add bus -->
    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Add a new bus</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add-bus') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Type</label>
                            <select class="form-control" id="type_id" name="type_id" required>
                                <option></option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Number of places</label>
                            <input type="number" class="form-control" id="places" name="places" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Immatriculation</label>
                            <input type="text" class="form-control" id="immatriculation" name="immatriculation" required>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for update bus -->
    @foreach ($bus as $bu)
        <div class="modal fade" id="exampleModalMessage{{ $bu->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('update-bus', $bu->id) }}" method="POST">
                            <div class="form-group">
                                <h5>Update bus</h5>
                            </div>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                {{ $bu->immatriculation }}
                                <input type="text" value=" {{ $bu->id }} " class="form-control" id="type"
                                    name="type" required disabled>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Number of places</label>
                                <input type="number" class="form-control" id="places" name="places" required>
                            </div>


                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Type</label>
                                <select class="form-control" id="type_id" name="type_id" required>
                                    <option></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn bg-gradient-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#all-tabs-simple" role="tab"
                    aria-controls="dashbaord" aria-selected="true">
                    All buses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#vip-tabs-simple" role="tab"
                    aria-controls="dashbaord" aria-selected="false">
                    VIP buses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#classic-tabs-simple" role="tab"
                    aria-controls="dashbaord" aria-selected="false">
                    Classic buses
                </a>
            </li>
        </ul>
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
                                            <h5 class="mb-0">All Buses</h5>
                                        </div>
                                        @if (auth()->user()->role_id == 2)
                                            <div class="d-flex">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn bg-gradient-success btn-block mb-3"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                                    +&nbsp; New Bus
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
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Immatriculation
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Places
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
                                @foreach ($bus as $bu)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->id }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->type->name }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->immatriculation }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->places }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->created_at }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            @if ($bu->status === 'active')
                                                <a href="/bus-status/{{ $bu->id }}/suspended" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="suspend bus">
                                                    <i class="fas fa-stop"></i>
                                                </a>
                                            @else
                                                <a href="/bus-status/{{ $bu->id }}/active" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="activate bus"><i
                                                        class="fas fa-solid fa-check"></i>
                                                </a>
                                            @endif
                                            <span>
                                                <a class="mx-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalMessage{{ $bu->id }}"
                                                    data-bs-toggle="tooltip" href="/update-bus/{{ $bu->id }}"
                                                    data-bs-original-title="update bus">
                                                    <i class="cursor-pointer fas fa-solid fa-pen text-secondary"></i>
                                                </a>
                                            </span>
                                            <span>
                                                <a class="mx-3" data-bs-toggle="tooltip"
                                                    href="/delete-bus/{{ $bu->id }}"
                                                    data-bs-original-title="delete bus">
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

        {{-- vip --}}
        <div class="tab-pane
                                                        fade" id="vip-tabs-simple"
            role="tabpanel" aria-labelledby="vip-tabs-simple-tab">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <div class="card-header pb-0">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <h5 class="mb-0">VIP Buses</h5>
                                        </div>
                                    </div>
                                </div>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Immatriculation
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Places
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
                                @foreach ($vipBus as $bu1)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu1->id }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu1->type->name }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu1->immatriculation }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu1->places }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu1->created_at }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            @if ($bu1->status === 'active')
                                                <a href="/bus-status/{{ $bu1->id }}/suspended" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="suspend bus">
                                                    <i class="fas fa-stop"></i>
                                                </a>
                                            @else
                                                <a href="/bus-status/{{ $bu1->id }}/active" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="activate bus"><i
                                                        class="fas fa-solid fa-check"></i>
                                                </a>
                                            @endif
                                            <span>
                                                <a class="mx-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalMessage{{ $bu1->id }}"
                                                    data-bs-toggle="tooltip" href="/update-bus/{{ $bu1->id }}"
                                                    data-bs-original-title="update bus">
                                                    <i class="cursor-pointer fas fa-solid fa-pen text-secondary"></i>
                                                </a>
                                            </span>

                                            <span>
                                                <a class="mx-3" data-bs-toggle="tooltip"
                                                    href="/delete-bus/{{ $bu1->id }}"
                                                    data-bs-original-title="delete bus">
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

        {{-- classic --}}
        <div class="tab-pane fade" id="classic-tabs-simple" role="tabpanel" aria-labelledby="classic-tabs-simple-tab">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <div class="card-header pb-0">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <h5 class="mb-0">Classic Buses</h5>
                                        </div>
                                    </div>
                                </div>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Immatriculation
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Places
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
                                @foreach ($classicBus as $bu)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->id }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->type->name }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->immatriculation }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->places }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $bu->created_at }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            @if ($bu->status === 'active')
                                                <a href="/bus-status/{{ $bu->id }}/suspended" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="suspend bus">
                                                    <i class="fas fa-stop"></i>
                                                </a>
                                            @else
                                                <a href="/bus-status/{{ $bu->id }}/active" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="activate bus"><i
                                                        class="fas fa-solid fa-check"></i>
                                                </a>
                                            @endif
                                            <span>
                                                <a class="mx-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalMessage{{ $bu->id }}"
                                                    data-bs-toggle="tooltip" href="/update-bus/{{ $bu->id }}"
                                                    data-bs-original-title="update bus">
                                                    <i class="cursor-pointer fas fa-solid fa-pen text-secondary"></i>
                                                </a>
                                            </span>

                                            <span>
                                                <a class="mx-3" data-bs-toggle="tooltip"
                                                    href="/delete-bus/{{ $bu->id }}"
                                                    data-bs-original-title="delete bus">
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
