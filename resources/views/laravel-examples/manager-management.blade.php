@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Managers</h5>
                        </div>
                        <div class="col-md-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                +&nbsp; New Manager
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="mb-0">new manager</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('add-manager')}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">First Name</label>
                                                    <input type="text" class="form-control" id="first-name" name="first_name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="last-name" name="last_name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Phone Number</label>
                                                    <input type="number" class="form-control" id="phone" name="phone" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Agency name</label>
                                                    <input type="text" class="form-control" id="agency" name="agency" required>
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
                </div>


                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
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
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Agency name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($managers as $manager)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $manager->id }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $manager->first_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $manager->last_name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $manager->email }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $manager->agency }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $manager->created_at }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($manager->status === 'active')
                                        <a href="/manager-status/{{$manager->id}}/suspended" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="suspend manager">
                                            <i class="fas fa-stop"></i>
                                        </a>
                                        @else
                                        <a href="/manager-status/{{$manager->id}}/active" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="activate manager"><i class="fas fa-solid fa-check"></i>
                                        </a>
                                        @endif
                                        <span>
                                            <a class="mx-3" data-bs-toggle="tooltip" href="/delete-manager/{{ $manager->id }}" data-bs-original-title="delete manager">
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