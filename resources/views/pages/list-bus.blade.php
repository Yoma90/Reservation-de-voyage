@extends('layouts.user_type.auth')

@section('content')
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
                                    </div>
                                </div>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Immatriculation
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
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bus as $bu)
                                @foreach ($agencies as $agency )

                                    <tr>
                                        <td class="text-center">
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
                                                {{ $agency->agency }}
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- vip --}}
        <div class="tab-pane fade" id="vip-tabs-simple" role="tabpanel" aria-labelledby="vip-tabs-simple-tab">
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Immatriculation
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
                                @foreach ($vipBus as $bu)
                                    <tr>
                                        <td class="text-center">
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Immatriculation
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
                                        <td class="text-center">
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
