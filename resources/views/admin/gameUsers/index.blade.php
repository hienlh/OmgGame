@extends('admin.layouts.admin')

@section('title', __('views.admin.gameUsers.index.title', ['name' => $game->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.gameUsers.index.table_header_name') }}</th>
                <th>{{ __('views.admin.gameUsers.index.table_header_avatar') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($game_users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td><img src="{{ asset($user->avatar) }}" class="user-profile-image" alt="" style="width: 50px"></td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.extraInfos.index', [$user->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.gameUsers.index.extra_info') }}">
                            <i class="fa fa-info"></i>
                        </a>
                        <a href="{{ route('admin.gameUsers.destroy', [$game->id, $user->id]) }}"
                           class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.gameUsers.index.delete') }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
