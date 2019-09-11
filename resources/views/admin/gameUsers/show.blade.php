@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.gameUsers.show.delete_title') }} <a
                                href="{{route('admin.gameUsers.index', [$game->id])}}" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>{{ __('views.admin.gameUsers.show.confirm') }}</p>

                    <form method="POST" action="{{ route('admin.gameUsers.destroy', [$game->id, $game_user->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>{{ __('views.admin.gameUsers.show.avatar') }}</th>
                <td><img src="{{ asset($game_user->avatar) }}" class="user-profile-image" alt="" style="width: 120px"></td>
            </tr>

            <tr>
                <th>{{ __('views.admin.gameUsers.show.name') }}</th>
                <td>{{ $game_user->name }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
