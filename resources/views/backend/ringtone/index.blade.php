@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('_partials._messages')
                <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            {{ __('All Ringtones') }}
                            <a class="text-primary" href="{{route('ringtones.create')}}">New ringtone</a>
                        </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">File</th>
                                <th scope="col">Size</th>
                                <th scope="col">Download</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ringtones as $key => $ringtone)
                            <tr>
                                <th scope="row">{{ $key + 1  }}</th>
                                <td>{{$ringtone->title}}</td>
                                <td>{{$ringtone->description}}</td>
                                <td>{{$ringtone->category->name}}</td>
                                <td>
                                    <audio controls onplay="pauseOthers(this)">
                                        <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </td>
                                <td>{{$ringtone->size}} bytes</td>
                                <td>{{$ringtone->download}}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-success" href="{{route('ringtones.edit', $ringtone)}}">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('ringtones.destroy', $ringtone)}}" method="post"
                                    onSubmit="return confirm('Are you sure?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                               @empty <td>No ringtones</td>
                            @endforelse

                            </tbody>
                        </table>
                        {{$ringtones->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
