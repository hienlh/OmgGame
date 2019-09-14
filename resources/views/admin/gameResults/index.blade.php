@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ __('views.admin.gameResults.index.title', ['name' => $game->name]) }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a href="{{ route('admin.gameResults.create', [$game->id]) }}"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        @foreach($results as $result)
                            <div class="col-md-55">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="{{ asset($result->image) }}" alt="image"/>
                                        <div class="mask">
                                            <p style="color: rgba(255,255,255,0)">_</p>
                                            <div class="tools tools-bottom">
                                                <a href="{{ route('admin.conditions.index', [$result->id]) }}"><i
                                                            class="fa fa-link"></i></a>
                                                <a href="{{ route('admin.gameResults.edit', [$game->id, $result->id]) }}"><i
                                                            class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.gameResults.destroy', [$game->id, $result->id]) }}"><i
                                                            class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>{{ $result->description }}</p>
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
