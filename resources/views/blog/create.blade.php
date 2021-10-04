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
            Create new post
        </h2>
    </div><br>
    <div class="container mt-5 mb-5">
        <form action="/blog" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Contenu</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-group">
                <select class="custom-select" name="category_id" required>
                    <option value=""></option>

                    @foreach ($categories as $cat)

                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>

                    @endforeach
                </select>
            </div>

            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="validatedCustomFile" required>
                <label class="custom-file-label" for="validatedCustomFile">Choose Image...</label>
            </div>

            <br>
            <button type="submit" class="mt-2 btn btn-primary ">Submit</button>
        </form>

    </div>

@endsection
