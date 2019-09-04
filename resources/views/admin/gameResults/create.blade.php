@extends('admin.layouts.admin')

@section('title',__('views.admin.gameResults.create.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open([
                'route'=>['admin.gameResults.store', $game->id],
                'method' => 'post',
                'class'=>'form-horizontal form-label-left',
                'id'=>'form',
                'files' => true
                ]) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    {{ __('views.admin.gameResults.create.description') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="description" required>
                </div>
            </div>

            <div class="form-group">
                <input id="design" type="text" style="display: none"
                       name="design" readonly>
                <input id="imageBackground" type="file" style="display: none"
                       name="imageBackground" accept="image/*" onchange="selectBackground(this);">
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary"
                       href="{{ URL::previous() }}"> {{ __('views.admin.gameResults.create.cancel') }}</a>
                    <button type="submit"
                            class="btn btn-success"> {{ __('views.admin.gameResults.create.submit') }}</button>
                </div>
            </div>
            {{ Form::close() }}

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.gameResults.create.design_tab_title') }}</h2>
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
