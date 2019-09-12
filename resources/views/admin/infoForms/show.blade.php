@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.infoForms.show.delete_title', ['name' => $infoForm->name]) }} <a
                                href="{{route('admin.infoForms.index', [$game->id])}}" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>{{ __('views.admin.infoForms.show.confirm') }}</p>

                    <form method="POST" action="{{ route('admin.infoForms.destroy', [$game->id, $infoForm->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
