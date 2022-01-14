@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <div class="panel panel-default">
                <div class="panel-heading">Изменить тему</div>

                <div class="panel-body">
                    {!! Form::model($topic, ['route' => ['topics.update'], 'method' => 'post'])!!}
                        {!! Form::hidden('id', $topic->id) !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              {!! Form::label('title', 'Название') !!}
                              {!! Form::text('title', null, ['class' => 'form-control']) !!}
                              <small class="text-danger">{{ $errors->first('title') }}</small>
                          </div>  

                          <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                              {!! Form::label('body', 'Описание') !!}
                              {!! Form::textarea('body', null, ['class' => 'form-control ckeditor']) !!}
                              <small class="text-danger">{{ $errors->first('body') }}</small>
                          </div>
                          

                          {!! Form::submit('Обновить', ['class'=>'btn btn-primary btn-block']) !!}
        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="{{ url('js/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ url('js/ckeditor/config.js') }}"></script>
  
@endsection