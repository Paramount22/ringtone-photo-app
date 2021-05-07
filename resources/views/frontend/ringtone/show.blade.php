@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $ringtone->title }}</div>

                    <div class="card-body">
                        <audio controls onplay="pauseOthers(this)">
                            <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <form action="{{route('ringtones.download', $ringtone)}}" method="post">
                            @csrf
                            <button class="btn btn-outline-success">Download</button>
                        </form>
                        <a class="text-dark" href="{{route('ringtones')}}">Back</a>
                    </div>
                </div>
                <table class="table mt-4">
                    <tr>
                        <th>Name</th>
                        <td>{{$ringtone->title}}</td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>{{$ringtone->description}}</td>
                    </tr>

                    <tr>
                        <th>Format</th>
                        <td>{{$ringtone->format}}</td>
                    </tr>

                    <tr>
                        <th>Size</th>
                        <td>{{$ringtone->size}} bytes</td>
                    </tr>

                    <tr>
                        <th>Category</th>
                        <td>{{$ringtone->category->name}}</td>
                    </tr>

                    <tr>
                        <th>Download</th>
                        <td>{{$ringtone->download}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="wpac-comment"></div>
                <script type="text/javascript">
                    wpac_init = window.wpac_init || [];
                    wpac_init.push({widget: 'Comment', id: 30444});
                    (function() {
                        if ('WIDGETPACK_LOADED' in window) return;
                        WIDGETPACK_LOADED = true;
                        var mc = document.createElement('script');
                        mc.type = 'text/javascript';
                        mc.async = true;
                        mc.src = 'https://embed.widgetpack.com/widget.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                    })();
                </script>
                <a href="https://widgetpack.com" class="wpac-cr">Comments System WIDGET PACK</a>
            </div>
        </div>


    </div>
@endsection
