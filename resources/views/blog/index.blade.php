@extends('layouts.homeLayout')
@section('content')
    @if (session()->has('message'))
        <div>
            <p>{{ session()->get('message') }}</p>
        </div>
    @endif

    <div class="col-12 mt-5" style="text-align: center;">
        <h2 class="mb-0">
            Dernières Actualitées
        </h2>
    </div><br>
    @if (auth()->check())
        @if (auth()->user()->role == 'Publisher')
            <a type="button" href="{{ url('blog/create') }}" class="btn btn-primary btn-lg float-right">Create new
                post</a><br>

        @endif
    @endif

    <div class="container mt-5 mb-5">

        @foreach ($posts as $post)

            <div class="card" style="width: 100%; flex-direction: row;">
                <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" style="width: 30%;"
                    alt="{{ $post->title }}">
                <div class="card-body">
                    <a href="/blog/{{ $post->slug }}">
                        <h5 class="card-title">{{ $post->title }}</h5>
                    </a>
                    <p class="card-text">Contenu : {{ $post->body }}</p>
                    <p>category: &nbsp; &nbsp;{{ $post->category->name }} </p>
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
        @endforeach
    </div>

    <div class="d-flex justify-content-center navigation">
        {{-- {{ $posts->links() }} --}}
    </div>
@endsection
