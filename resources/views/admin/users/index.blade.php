@extends('admin.layouts.admin')

@section('title', __('views.admin.users.index.title'))

@section('content')
    <div class="row">
        <a href="{{route('admin.users.create')}}" class="btn btn-info btn-xs"><i
                class="fa fa-plus"></i> {{ __('views.admin.users.index.create') }} </a>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.users.index.table_header_name') }}</th>
                <th>{{ __('views.admin.users.index.table_header_email') }}</th>
                <th>{{ __('views.admin.users.index.table_header_role') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles()->pluck('display_name')->implode(', ') }}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', [$user->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.users.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        @if($user->name != 'admin')
                            <a href="{{ route('admin.users.destroy', [$user->id]) }}"
                               class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.users.index.delete') }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $users->links() }}
        </div>
    </div>
@endsection
