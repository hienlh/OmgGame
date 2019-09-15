@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.result_conditions.show.delete_title', ['name' => $condition->info_form->name]) }} <a
                                href="{{route('admin.conditions.index', [$result->id])}}" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>{{ __('views.admin.confirm_delete_text') }}</p>

                    <form method="POST" action="{{ route('admin.conditions.destroy', [$result->id, $condition->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">{{ __('views.admin.confirm_delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
