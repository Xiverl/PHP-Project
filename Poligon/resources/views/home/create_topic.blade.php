@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <div class="panel panel-default">
                <div class="panel-heading">Создать новую тему</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel-body">
                    {!! Form::open(['route' => 'home.store_topic'])!!}

                          <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                              {!! Form::label('category_id', 'Категория') !!}
                              {!! Form::select('category_id', $data, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('category_id') }}</small>
                          </div>

                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              {!! Form::label('title', 'Заголовок') !!}
                              {!! Form::text('title', null, ['class' => 'form-control']) !!}
                              <small class="text-danger">{{ $errors->first('title') }}</small>
                          </div>

                          <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                              {!! Form::label('body', 'Описание') !!}
                              {!! Form::textarea('body', null, ['class' => 'form-control ckeditor']) !!}
                              <small class="text-danger">{{ $errors->first('body') }}</small>
                          </div>

                          {!! Form::submit('Создать тему', ['class'=>'btn btn-primary btn-block']) !!}
        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="js/ckeditor/ckeditor.js"></script>
  <script src="js/ckeditor/config.js"></script>

@endsection