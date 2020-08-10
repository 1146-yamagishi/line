@extends('layouts.admin')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class=row>
            <h2>投稿一覧</h2>
        </div>
        <div class=row>
            <div class="col-md-4">
                <a href="{{ action('Admin\LineController@create') }}" role="button" class="btn btn-primary">新規投稿</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\LineController@index') }}" method="get" class="form-inline justify-content-end">
                    <div class="form-group">
                        <label>タイトル</label>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mx-2" name="cond_title" value="{{ $cond_title }}" size="40">
                    </div>
                    <input type="submit" class="btn btn-primary" value="検索">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="row">
            <div class="posts col-md-6 mx-auto mt-3">
                @foreach($informations as $post)
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
                                    <img src="{{  $post->image_path }}"　width="550" height="450">
                                @endif
                            </div>
                        </div>
                        <div class=row>
                            @if($post->is_evaluationed_by_auth_user())
                            <a href="{{ route('post.unevaluation', ['id' => $post->id]) }}" class="btn btn-success btn-sm">共感！<span class="badge">{{ $post->evaluations->count() }}</span></a>
                            @else
                            <a href="{{ route('post.evaluation', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">共感！<span class="badge">{{ $post->evaluations->count() }}</span></a>
                            @endif
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection