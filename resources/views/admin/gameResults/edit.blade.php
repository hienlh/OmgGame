@extends('admin.layouts.admin')

@section('title',__('views.admin.gameResults.edit.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Form::open([
                'route'=>['admin.gameResults.update', 'game_id' => $game->id, 'result_id' => $result->id],
                'files' => true,
                'id' => 'form',
                'method' => 'put',
                'class'=>'form-horizontal form-label-left',
             ]) !!}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.gameResults.edit.description') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('description')) parsley-error @endif"
                           name="description" value="{{ $result->description }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.gameResults.edit.image') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="image_link" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('image')) parsley-error @endif"
                           name="image" value="{{ $result->image }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ __('views.admin.gameResults.edit.design') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="design" type="text"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('design')) parsley-error @endif"
                           name="design" value="{{ $result->design }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <input id="imageBackground" type="file" style="display: none"
                       name="imageBackground" accept="image/*" onchange="selectBackground(this);">
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> {{ __('views.admin.gameResults.edit.cancel') }}</a>
                    <button type="submit"
                            class="btn btn-success"> {{ __('views.admin.gameResults.edit.save') }}</button>
                </div>
            </div>
            {{ Form::close() }}

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.gameResults.edit.design_tab_title') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="panel-body">
                            <a class="btn btn-app" id="uploadBtn">
                                <i class="fa fa-upload"></i> Background
                            </a>
                            <a class="btn btn-app" onclick="saveToImage();">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <a class="btn btn-app" onclick="createText();">
                                <i class="fa fa-file-text"></i> Add Text
                            </a>
                            <a class="btn btn-app" onclick="removeObject();">
                                <i class="fa fa-remove"></i> Remove
                            </a>
                            <a class="btn btn-app" onclick="toJson();">
                                <i class="fa fa-braille"></i> Log Json
                            </a>
                        </div>
                        <div id="container"></div>
                    </div>
                </div>
                <script src="https://unpkg.com/konva@4.0.4/konva.min.js"></script>
                <script src="{{ asset('admin/js/konva-editor.js') }}"></script>
            </div>
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
