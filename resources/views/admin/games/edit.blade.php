@extends('admin.layouts.admin')

@section('title',__('views.admin.games.edit.title', ['name' => $game->name]) )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open([
                'route'=>['admin.games.update', $game->id],
                'method' => 'put',
                'class'=>'form-horizontal form-label-left',
                'files'=>true
                ]) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.games.edit.name') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('name')) parsley-error @endif"
                           name="name" value="{{ $game->name }}" required>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('views.admin.games.edit.is_active') }}</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="">
                        <label>
                            <input type="checkbox" class="flat" value="is_active" name="is_active"
                                   @if($game->is_active) checked @endif /> {{ __('views.admin.games.edit.is_active') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question">
                    {{ __('views.admin.games.edit.question') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="question" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="question" value="{{ $game->question }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    {{ __('views.admin.games.edit.description') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="description" value="{{ $game->description }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                    {{ __('views.admin.games.create.image') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="image" type="file" name="image" accept="image/*">
                    <img src="{{ asset($game->image) }}" style="width: 120px"  alt=""/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> {{ __('views.admin.games.edit.cancel') }}</a>
                    <button type="submit" class="btn btn-success"> {{ __('views.admin.games.edit.save') }}</button>
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