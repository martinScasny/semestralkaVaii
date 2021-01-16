@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header login">{{ __('Používatelia') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @can('create',\App\Models\User::class)
                                <div class="mb-3">
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success" role="button">Add
                                        new user</a>
                                </div>
                            @endcan
                        <div class="login">
                            {!! $grid->show() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
