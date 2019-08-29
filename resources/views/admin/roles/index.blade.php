@extends('admin.layouts.admin')

@section('title', __('views.admin.roles.index.title'))

@section('content')
    <div class="row">
        <a href="{{route('admin.roles.create')}}" class="btn btn-info btn-xs"><i
                class="fa fa-plus"></i> {{ __('views.admin.roles.index.create') }} </a>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.roles.index.table_header_name') }}</th>
                <th>{{ __('views.admin.roles.index.table_header_display_name') }}</th>
                <th>{{ __('views.admin.roles.index.table_header_description') }}</th>
                <th>{{ __('views.admin.roles.index.table_header_permissions') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>{{ $role->perms()->pluck('display_name')->implode(', ') }}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', [$role->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.roles.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        @if($role->name != 'admin')
                            <a href="{{ route('admin.roles.destroy', [$role->id]) }}"
                               class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.roles.index.delete') }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $roles->links() }}
        </div>
    </div>
@endsection
