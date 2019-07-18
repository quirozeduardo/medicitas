<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('permissions.field_name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('administration.permissions.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
