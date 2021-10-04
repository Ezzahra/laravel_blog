@extends('layouts.homeLayout')
@section('content')
    @if ($errors->any())
        <div class="btn-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="col-12 mt-5" style="text-align: center;">
        <h2 class="mb-0">
            Create new category
        </h2>
    </div><br>
    <div class="container mt-5 mb-5">
        <form action="/category" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
            </div>

            <button type="submit" class="mt-2 btn btn-primary ">Submit</button>
        </form>

    </div>

@endsection
