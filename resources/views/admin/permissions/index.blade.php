@extends('admin.layouts.admin')

@section('title', __('views.admin.permissions.index.title'))

@section('content')
    <div class="row">
        <a href="{{route('admin.permissions.create')}}" class="btn btn-info btn-xs"><i
                class="fa fa-plus"></i> {{ __('views.admin.permissions.index.create') }} </a>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.permissions.index.table_header_name') }}</th>
                <th>{{ __('views.admin.permissions.index.table_header_display_name') }}</th>
                <th>{{ __('views.admin.permissions.index.table_header_description') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', [$permission->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.permissions.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="{{ route('admin.permissions.destroy', [$permission->id]) }}"
                           class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.permissions.index.delete') }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
