@extends('admin.layouts.admin')

@section('title',__('views.admin.infoForms.edit.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Form::open([
                'route'=>['admin.conditions.update', 'result_id' => $result->id, 'id' => $condition->id],
                'files' => true,
                'id' => 'form',
                'method' => 'put',
                'class'=>'form-horizontal form-label-left',
             ]) !!}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="key">
                    {{ __('views.admin.info_form') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="key" name="key" class="form-control @if($errors->has("condition")) parsley-error @endif"
                            required>
                        <option
                            value="{{ old('key') ?? $condition->key }}">
                            @if(old('key'))
                                @foreach($forms as $form)
                                    @if(old('key') == $form->key)
                                        {{ $form->name }}
                                        @break
                                    @endif
                                @endforeach
                            @else
                                @foreach($forms as $form)
                                    @if($condition->key == $form->key)
                                        {{ $form->name }}
                                        @break
                                    @endif
                                @endforeach
                            @endif
                        </option>
                        @foreach($forms as $form)
                            @if(old('key') && old('key') != $form->key)
                                <option value="{{ $form->key }}">{{ $form->name }}</option>
                            @elseif ($form->key != $condition->key)
                                <option value="{{ $form->key }}">{{ $form->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if($errors->has("key"))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get("key") as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="condition">
                    {{ __('views.admin.condition') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="condition" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has("condition")) parsley-error @endif"
                           name="condition" value="{{ old("condition") ?? $condition->condition }}" required>
                    @if($errors->has("condition"))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get("condition") as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="operator">
                    {{ __('views.admin.operator') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="operator" name="operator" class="form-control">
                        <option
                            value="{{ old('operator') ?? $condition->operator }}">{{ old('operator') ?? $condition->operator }}</option>
                        @foreach($operators as $operator)
                            @if(old('operator')  != $operator)
                                <option value="{{ $operator }}">{{ $operator }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if($errors->has("operator"))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get("operator") as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> {{ __('views.admin.infoForms.edit.cancel') }}</a>
                    <button type="submit"
                            class="btn btn-success"> {{ __('views.admin.infoForms.edit.save') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}
@endsection
