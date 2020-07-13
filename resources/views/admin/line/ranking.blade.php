@extends('layouts.admin')

@section('content')
<div class="container">
    <hr color="#c0c0c0">
    <div class=row>
        <h2>ランキング発表 TOP10</h2>
    </div>
    <div class="row">
        <div class="posts col-md-6 mx-auto mt-3">
            @foreach($informations as $post)
            <div class=ranking >{{$loop->iteration}}位</div>
                <div class="post">
                    <div class="row">
                        <div class="text col-md-6">
                            <div class="date">
                                {{ $post->updated_at->format('Y年m月d日') }}
                            </div>
                            <div class="title">
                                <b>{{ str_limit($post->title, 100) }}</b>
                            </div>
                            <div class="comment mt-3">
                                {{ str_limit($post->comment, 1000) }}
                            </div>
                        </div>
                        <div class="image col-md-6 text-right mt-6">
                            @if ($post->image_path)
                                <img src="{{ asset('storage/image/' . $post->image_path) }}"　width="550" height="450">
                            @endif
                        </div>
                        <div class="row　botan">
                            @if($post->is_evaluationed_by_auth_user())
                            <a href="{{ route('post.unevaluation', ['id' => $post->id]) }}" class="btn btn-success btn-sm">共感！<span class="badge">{{ $post->evaluations->count() }}</span></a>
                            @else
                            <a href="{{ route('post.evaluation', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">共感！<span class="badge">{{ $post->evaluations->count() }}</span></a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr color="#c0c0c0">
            @endforeach
        </div>
    </div>
</div>
@endsection