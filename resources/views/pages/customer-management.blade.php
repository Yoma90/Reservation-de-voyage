@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#all-tabs-simple" role="tab" aria-controls="dashbaord" aria-selected="true">
                    All customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#actived-tabs-simple" role="tab" aria-controls="dashbaord" aria-selected="false">
                    Active customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#suspended-tabs-simple" role="tab" aria-controls="dashbaord" aria-selected="false">
                    Suspended customers
                </a>
            </li>
        </ul>
    </div>

    <!-- All -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all-tabs-simple" role="tabpanel" aria-labelledby="all-tabs-simple-tab">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <div class="card-header pb-0">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <h5 class="mb-0">All customers</h5>
                                        </div>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                First Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Last Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                User Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Creation Date
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </div>
                                </div>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->id }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->first_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->last_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->user_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->email }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $customer->created_at }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($customer->status === 'active')
                                        <a href="/user-status/{{$customer->id}}/suspended" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="suspend customer">
                                            <i class="fas fa-stop"></i>
                                        </a>
                                        @else
                                        <a href="/user-status/{{$customer->id}}/active" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="activate customer"><i class="fas fa-solid fa-check"></i>
                                        </a>
                                        @endif
                                        <span>
                                            <a class="mx-3" data-bs-toggle="tooltip" href="/delete-user/{{ $customer->id }}" data-bs-original-title="delete customer">
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

        <!-- Active -->
        <div class="tab-pane fade" id="actived-tabs-simple" role="tabpanel" aria-labelledby="actived-tabs-simple-tab">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <div class="card-header pb-0">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <h5 class="mb-0">Active customers</h5>
                                        </div>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                First Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Last Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                User Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Creation Date
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </div>
                                </div>
                            </thead>
                            <tbody>
                                @foreach ($activeCustomers as $customer)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->id }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->first_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->last_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->user_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->email }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $customer->created_at }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="/user-status/{{$customer->id}}/suspended" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="suspend customer">
                                            <i class="fas fa-stop"></i>
                                        </a>
                                        <!-- <span>
                                            <a class="mx-3" data-bs-toggle="tooltip" href="/delete-user/{{ $customer->id }}" data-bs-original-title="delete customer">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>
                                        </span> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suspended -->
        <div class="tab-pane fade" id="suspended-tabs-simple" role="tabpanel" aria-labelledby="suspended-tabs-simple-tab">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <div class="card-header pb-0">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <h5 class="mb-0">Suspended customers</h5>
                                        </div>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                First Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Last Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                User Name
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Creation Date
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </div>
                                </div>
                            </thead>
                            <tbody>
                                @foreach ($suspendedCustomers as $customer)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->id }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->first_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->last_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->user_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $customer->email }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $customer->created_at }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="/user-status/{{$customer->id}}/active" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="activate customer"><i class="fas fa-solid fa-check"></i>
                                        </a>
                                        <!-- <span>
                                            <a class="mx-3" data-bs-toggle="tooltip" href="/delete-user/{{ $customer->id }}" data-bs-original-title="delete customer">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>
                                        </span> -->
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