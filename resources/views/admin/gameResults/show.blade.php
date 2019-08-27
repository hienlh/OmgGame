@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.gameResults.show.delete_title') }} <a
                                href="{{route('admin.gameResults.index', [$game->id])}}" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>{{ __('views.admin.gameResults.show.confirm') }}</p>

                    <form method="POST" action="{{ route('admin.gameResults.destroy', [$game->id, $result->id]) }}">
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
                <th>{{ __('views.admin.gameResults.show.image') }}</th>
                <td><img src="{{ asset($result->image) }}" class="user-profile-image" alt="" style="width: 120px"></td>
            </tr>

            <tr>
                <th>{{ __('views.admin.gameResults.show.description') }}</th>
                <td>{{ $result->description }}</td>
            </tr>

            <tr>
                <th>{{ __('views.admin.gameResults.show.design') }}</th>
                <td>{{ $result->design }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection