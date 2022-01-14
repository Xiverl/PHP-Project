@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          
            <div class="panel panel-default">
                <div class="panel-heading">Изменение комментария</div>

                <div class="panel-body">
                  {!! Form::model($comment, ['route' => ['comments.update'], 'method' => 'post'])!!}
                        {{-- to redirect to current page --}}
                    {!! Form::hidden('topicSlug', $comment->commentable_id) !!}
                    {!! Form::hidden('id', $comment->id) !!}
                    {!! Form::hidden('page', request('page')) !!}
                        @include('comments._form', ['model' => $comment])
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