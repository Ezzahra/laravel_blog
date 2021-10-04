@extends('layouts.homeLayout')
@section('content')
    @if (session()->has('message'))
        <div>
            <p class="d-flex justify-content-centerbtn btn-danger">{{ session()->get('message') }}</p>
        </div>
    @endif
    <div class="col-12 mt-5" style="text-align: center;">
        <h2 class="mb-0">
            List of categories
        </h2>
    </div><br>
    @if (auth()->user()->isAdmin() == 'Admin')
        <a type="button" href="{{ url('category/create') }}" class="btn btn-primary btn-lg float-right">Create new
            category</a>
    @endif
    <div class="container mt-5 mb-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>

                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if ($user->canPublish)
                                <a href="{{ route('blockUser', ['id' => $user->id]) }}"
                                    class="btn btn-danger btn-sm">Block</a>
                            @else
                                <a href="{{ route('unblockUser', ['id' => $user->id]) }}"
                                    class="btn btn-success btn-sm">unBlock</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-center navigation">
            {{ $users->links() }}
        </div>
    @endsection
