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
                    @if (auth()->user()->isAdmin() == 'Admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        @if (auth()->user()->isAdmin() == 'Admin' && $category->name != 'uncategorized')

                            <td>
                                <a type="button" href="/category/{{ $category->id }}/edit"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <span class="float-right">
                                    <form action="category/{{ $category->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button  OnClick="confirm('Voulez-vous vraiment supprimer ?');" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </span>
                            </td>
                        @endif
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-center navigation">
            {{ $categories->links() }}
        </div>
    @endsection
