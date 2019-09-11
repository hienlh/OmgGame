@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($title) ? $title : __('views.admin.gameUsers.index.title', ['name' => $game->name]) }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        @foreach($game_users as $user)
                            <div class="col-md-55">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="{{ asset($user->avatar) }}"
                                             alt="image"/>
                                        <div class="mask">
                                            <p style="color: rgba(255,255,255,0)">_</p>
                                            <div class="tools tools-bottom">
                                                <a href="#"><i
                                                        class="fa fa-list-alt"></i></a>
                                                <a href="{{ route('admin.gameUsers.games', [$user->id]) }}"><i
                                                        class="fa fa-gamepad"></i></a>
                                                <a href="{{ route('admin.gameUsers.destroy', [$game->id, $user->id]) }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>{{ $user->name }}</p>
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
