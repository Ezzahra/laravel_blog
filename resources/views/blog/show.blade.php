@extends('layouts.homeLayout')
@section('content')

    <div class="col-12 mt-5" style="text-align: center;">
        <h2 class="mb-0">
            {{ $post->title }}
        </h2>
    </div><br>
    <a type="button" href="{{ url('blog') }}" class="btn btn-primary btn-lg float-right">List of posts</a>
    <div class="card" style="width: 100%; flex-direction: row;">
        <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" style="width: 30%;"
            alt="{{ $post->title }}">
        <div class="card-body">

            <p class="card-text">Contenu : {{ $post->body }}</p>
            <p>category: &nbsp; &nbsp;{{ $post->category->name }} : </p>
            <p class="card-text"><small class="text-muted">publiée le
                    {{ date('jS M Y', strtotime($post->created_at)) }}</small></p>
            <p class="card-text"><small class="text-muted">By : {{ $post->user->name }}</small></p>

            @if (auth()->check())

                <a href="/blog/{{ $post->slug }}/edit" class="btn btn-primary">Edit</a>
                <span class="float-right">
                    <form action="blog/{{ $post->slug }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </span>
            @endif
        </div>
    </div>
    <br>
@endsection
