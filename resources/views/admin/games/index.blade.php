@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($title) ? $title : __('views.admin.games.index.title') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a href="{{ route('admin.games.create') }}"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        @foreach($games as $game)
                            <div class="col-md-55">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="{{ asset($game->image) }}" alt="image"/>
                                        <div class="mask">
                                            <p>
                                            @if($game->is_active)
                                                <span class="label label-primary">{{ __('views.admin.games.show.active') }}</span>
                                            @else
                                                <span class="label label-danger">{{ __('views.admin.games.show.inactive') }}</span>
                                            @endif
                                            </p>
                                            <div class="tools tools-bottom">
                                                <a href="{{ route('admin.gameResults.index', ['game_id' => $game->id]) }}"><i
                                                            class="fa fa-list-alt"></i></a>
                                                <a href="{{ route('admin.gameUsers.index', ['game_id' => $game->id]) }}"><i
                                                            class="fa fa-group"></i></a>
                                                <a href="{{ route('admin.games.edit', [$game->id]) }}"><i
                                                            class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.games.destroy', [$game->id]) }}"><i
                                                            class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>{{ $game->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
