@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                <a href="{{ route('topics.comments.create', ['id'=>$topic->id]) }}"
                   class="btn btn-default pull-left">Оставить комментарий</a>

        </span>
                <br>
                <br>


                {{-- Post page --}}

                @if (!request('page') == 1 or request('page') == 1)
                    <div class="panel panel-default change-panel">
                        <div class="panel-heading">
                            <img src="http://ivan.new.russianitgroup.ru/images/new.jpg" alt="" style="width:90px;height:70px;" class="pull-left img-rounded">
                            <div class="topic-panel">

                                @if(Auth::check() && Auth::user()->id == $topic->user->id)
                                    <a href="/topics.edit?id={{ $topic->id }}" class="btn btn-default pull-right" style="padding:3px 10px;">Изменить</a>
                                @endif
                                <h4>&nbsp;&nbsp;{{ $topic->title }}</h4>
                                <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >{{ ucwords($topic->user->name) }}</a></h5>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                {!! $topic->body !!}
                            </li>
                        </ul>
                    </div>
                @endif


                {{-- Comment page --}}

                @foreach ($comments as $comment)
                    <div class="panel panel-default change-panel">
                        <div class="panel-heading" style="padding-bottom:15px;">
                            <img src="http://ivan.new.russianitgroup.ru/images/new.jpg"  style="width:90px;height:70px;" class="pull-left img-rounded">
                            <div class="topic-panel">
                                @if(Auth::check() && Auth::user()->id == $comment->user_id)
                                    <a href="/topics.comments.edit?id={{ $comment->id }}" class="btn btn-default pull-right" style="padding:3px 10px;">Редактирование комментария</a>
                                @endif
                                <h5>&nbsp;&nbsp;&nbsp;<a href="#" style="color:#777;" >{{ ucwords($comment->user->name) }}</a></h5>
                                <h5>&nbsp;&nbsp;{{ $comment->created_at }}</h5>
                            </div>
                        </div>

                        <ul class="list-group">
                            <li class="list-group-item">
                                {!! $comment->body !!}
                            </li>
                        </ul>
                    </div>
                @endforeach

                <span class="pull-right">
        </span>


            </div>
        </div> {{-- end col-12 --}}
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/bootstrap-rating.css') }}">
    <style>
        .rating-symbol{
            color: #f6e729;
            height: 20px;
        }
        .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            font-size: 21px;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
@endsection

@section('script')

@stop

