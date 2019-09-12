@extends('admin.layouts.admin')

@section('title',__('views.admin.infoForms.create.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open([
                'route'=>['admin.infoForms.store', $game->id],
                'method' => 'post',
                'class'=>'form-horizontal form-label-left',
                'id'=>'form',
                'files' => true
                ]) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.infoForms.create.name') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('name')) parsley-error @endif"
                           name="name" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('name') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="key">
                    {{ __('views.admin.infoForms.create.key') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="key" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has("key")) parsley-error @endif"
                           name="key" value="{{ old("key") }}" required>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                    {{ __('views.admin.infoForms.create.type') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="type" name="type" class="form-control" required>
                        <option
                            value="{{ old('type') }}">{{ old('type') ?: __('views.admin.infoForms.create.choose_type') }}</option>
                        @foreach($types as $type)
                            @if(old('type') != $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    {{ __('views.admin.infoForms.create.description') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has("description")) parsley-error @endif"
                           name="description" value="{{ old("description") }}" required>
                    @if($errors->has("description"))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get("description") as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> {{ __('views.admin.infoForms.create.cancel') }}</a>
                    <button type="submit"
                            class="btn btn-success"> {{ __('views.admin.infoForms.create.submit') }}</button>
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
