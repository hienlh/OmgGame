@extends('admin.layouts.admin')

@section('title',__('views.admin.banner.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open([
                'route'=>['admin.updateBanner'],
                'method' => 'put',
                'class'=>'form-horizontal form-label-left',
                'files'=>true
                ]) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                    {{ __('views.admin.banner.top_banner') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="top_banner" accept="image/*" value="old('top_banner')">
                    <img src="{{ asset($user->top_banner) }}" style="width: 120px"  alt=""/>
                    @if($errors->has('top_banner'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('top_banner') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                    {{ __('views.admin.banner.bottom_banner') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="bottom_banner" type="file" name="bottom_banner" accept="image/*" value="old('bottom_banner')">
                    <img src="{{ asset($user->bottom_banner) }}" style="width: 120px"  alt=""/>
                    @if($errors->has('bottom_banner'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('bottom_banner') as $error)
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
                       href="{{ URL::previous() }}"> {{ __('views.admin.cancel') }}</a>
                    <button type="submit" class="btn btn-success"> {{ __('views.admin.save') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
