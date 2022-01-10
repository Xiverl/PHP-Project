<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Текст комментария') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control ckeditor']) !!}
    <small class="text-danger">{{ $errors->first('body') }}</small>
</div>




{!! Form::submit(isset($model) ? 'Обновить' : 'Сохранить', ['class'=>'btn btn-primary btn-block']) !!}

