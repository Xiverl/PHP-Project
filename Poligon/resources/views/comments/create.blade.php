@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <div class="panel panel-default">
                <div class="panel-heading">Ваш комментарий</div>

                <div class="panel-body">
                  {!! Form::open(['route' => ['topics.comments.store', 'id'=>$topicSlug]])!!}
                        @include('comments._form')
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