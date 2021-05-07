@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('_partials._messages')
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('All Photos') }}
                        <a class="text-primary" href="{{route('photos.create')}}">New photo</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Format</th>
                                <th scope="col">Size</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($photos as $key => $photo)
                                <tr>
                                    <th scope="row">{{ $key + 1  }}</th>
                                    <td><img src="/uploads/{{$photo->file}}" width="100" alt="{{$photo->title}}">
                                    </td>
                                    <td>{{$photo->title}}</td>
                                    <td>{{$photo->description}}</td>
                                    <td>{{$photo->format}}</td>
                                    <td>{{ round($photo->size * 0.001, 2) }} kb</td>

                                    <td>
                                        <a class="btn btn-sm btn-outline-success" href="{{route('photos.edit', $photo)
                                        }}">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{route('photos.destroy', $photo)}}" method="post"
                                              onSubmit="return confirm('Are you sure?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty <td>No photos</td>
                            @endforelse

                            </tbody>
                        </table>
                        {{$photos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
