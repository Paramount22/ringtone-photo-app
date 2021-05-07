@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($ringtones as $ringtone)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            {{ $ringtone->title }}
                            <a href="{{route('ringtones.category', $ringtone->category_id)
                            }}">{{$ringtone->category->name}}</a>
                        </div>
                        <div class="card-body">
                            <audio controls onplay="pauseOthers(this)">
                                <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('ringtones.show', [$ringtone->id, $ringtone->slug])}}"
                               class="text-info">Info
                                and download</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Categries</div>
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <div class="card-header">
                                <a href="{{route('ringtones.category', $category)}}"
                                   class="text-info">{{$category->name}}</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            {{$ringtones->links()}}
        </div>
    </div>
@endsection
