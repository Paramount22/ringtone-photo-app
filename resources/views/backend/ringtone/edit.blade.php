@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('_partials._messages')
                <div class="card">
                    <div class="card-header">Edit RingTone</div>
                    <div class="card-body">
                        <form action="{{route('ringtones.update', $ringtone)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid
                                    @enderror" id="title" value="{{$ringtone->title}}">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description"
                                          id="description" rows="3">{{$ringtone->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                                       id="title" accept="audi/*">

                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Choose category</label>
                                <select class="form-control @error('category') is-invalid @enderror" id="category"
                                        name="category">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            @if($category->id == $ringtone->category_id)
                                                selected
                                            @endif
                                        >
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
