@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.permissions.show.delete_title', ['name' => $permission->name]) }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>{{ __('views.admin.permissions.show.confirm', ['name' => $permission->name]) }}</p>

                    <form method="POST" action="{{ route('admin.permissions.destroy', ['id' => $permission->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
