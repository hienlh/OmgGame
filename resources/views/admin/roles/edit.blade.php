@extends('admin.layouts.admin')

@section('title',__('views.admin.roles.edit.title', ['name' => $role->name]) )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open([
                'route'=>['admin.roles.update', $role->id],
                'method' => 'put',
                'class'=>'form-horizontal form-label-left'
                ]) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.roles.edit.name') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('name')) parsley-error @endif"
                           name="name" value="{{ $role->name }}" required readonly>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="display_name">
                    {{ __('views.admin.roles.edit.display_name') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="display_name" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="display_name" value="{{ $role->display_name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    {{ __('views.admin.roles.edit.description') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="description" value="{{ $role->description }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="permissions">
                    {{ __('views.admin.roles.edit.permissions') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="permissions" name="permissions[]" class="select2" multiple="multiple"
                            style="width: 100%" autocomplete="off" @if($role->name == 'admin') readonly @endif>
                        @foreach($permissions as $permission)
                            <option @if($role->perms()->find($permission->id)) selected="selected"
                                    @endif value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> {{ __('views.admin.roles.edit.cancel') }}</a>
                    <button type="submit" class="btn btn-success"> {{ __('views.admin.roles.edit.save') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
