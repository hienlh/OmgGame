@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.games.show.delete_title', ['name' => $game->name]) }} <a
                                href="{{route('admin.games.index')}}" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>{{ __('views.admin.games.show.confirm', ['name' => $game->name]) }}</p>

                    <form method="POST" action="{{ route('admin.games.destroy', ['id' => $game->id]) }}">
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
                <th>{{ __('views.admin.games.show.image') }}</th>
                <td><img src="{{ asset($game->image) }}" class="user-profile-image" alt="" style="width: 120px"></td>
            </tr>

            <tr>
                <th>{{ __('views.admin.games.show.name') }}</th>
                <td>{{ $game->name }}</td>
            </tr>

            <tr>
                <th>{{ __('views.admin.games.show.question') }}</th>
                <td>
                    {{ $game->question }}
                </td>
            </tr>
            <tr>
                <th>{{ __('views.admin.games.show.description') }}</th>
                <td>
                    {{ $game->description }}
                </td>
            </tr>
            <tr>
                <th>{{ __('views.admin.games.show.is_active') }}</th>
                <td>
                    @if($game->is_active)
                        <span class="label label-primary">{{ __('views.admin.games.show.active') }}</span>
                    @else
                        <span class="label label-danger">{{ __('views.admin.games.show.inactive') }}</span>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection