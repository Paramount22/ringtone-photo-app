@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($photos as $photo)
                    <div class="card mt-3">
                        <div class="card-header">{{ $photo->title }}</div>
                        <div class="card-body">
                            <p>{{$photo->description}}</p>
                            <p>
                                <img class="img-thumbnail" src="/uploads/{{$photo->file}}" alt="{{ $photo->title }}">
                            </p>
                        </div>

                        <div class="card-footer d-flex justify-content-around">
                            <form action="{{route('photos.download1', $photo)}}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-success">Download 800x600</button>
                            </form>
                            <form action="{{route('photos.download2', $photo)}}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary">Download 1280x1024</button>
                            </form>
                            <form action="{{route('photos.download3', $photo)}}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-info">Download 316x255</button>
                            </form>
                            <form action="{{route('photos.download4', $photo)}}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">Download 118x95</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$photos->links()}}
        </div>
    </div>
@endsection
