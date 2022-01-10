@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('home.create_topic') }}" class="btn btn-default pull-right">Создать новую тему</a>
          <br>
          <br>
        </div>
        
        <div class="col-md-2">
          <div class="list-group">
            <a class="list-group-item active">Форум</a>
            @if (count($forums) == null)
              <a href="#" class="list-group-item">Нет форумов</a>
            @endif
            @foreach ($forums as $forum)
              <a href="{{ route('forums.show', $forum) }}" class="list-group-item">{{ $forum->name }}</a>
            @endforeach
          </div>
        </div>
        <div class="col-md-10">
          

          <div class="panel panel-default">
            <div class="panel-heading">
              <b>Последнее сообщение</b><span class="pull-right glyphicon glyphicon-pushpin"></span>
            </div>

            @if (count($topics) == null)
                <ul class="list-group"> 
                  <a href="#" class="list-group-item">
                    Нет постов
                  </a>
                </ul>
            @endif

            @foreach($topics as $topic)
                <ul class="list-group">
                  <a href="/topics.show?id={{ $topic->id }}" class="list-group-item" style="padding:10px 1px">
                    <div class="col-md-10 col-xs-9">
                      {{ $topic->title }} <br>
                    </div>
                    <p style="font-size:12px;margin-top:2px;" class="">
                      <span class="fa fa-comments"></span> : {{ count($topic->comments) }} Ответы <br>
                      <span class="glyphicon glyphicon-eye-open"></span> : {{ $topic->views }} Просмотры
                    </p>
                  </a>
                </ul>
            @endforeach
          </div>

        </div>
    </div>
</div>
@endsection

