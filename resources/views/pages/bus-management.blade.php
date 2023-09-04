@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Bus</h5>
                        </div>
                        <div class="col-md-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                +&nbsp; New Bus
                            </button>

                            
                        </div>
                    </div>
                </div>

                <h3>Bus</h3>

                
            </div>
        </div>
    </div>
</div>
@endsection