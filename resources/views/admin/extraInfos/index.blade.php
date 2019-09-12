@extends('admin.layouts.admin')

@section('title', __('views.admin.extraInfos.index.title', ['name' => $game_user->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.extraInfos.index.table_header_form') }}</th>
                <th>{{ __('views.admin.extraInfos.index.table_header_key') }}</th>
                <th>{{ __('views.admin.extraInfos.index.table_header_description') }}</th>
                <th>{{ __('views.admin.extraInfos.index.table_header_value') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($infos as $info)
                <tr>
                    <td>{{ $info->info_form->name }}</td>
                    <td>{{ $info->key }}</td>
                    <td>{{ $info->description }}</td>
                    <td>{{ $info->value }}</td>
                    <td>
                        <a href="{{ route('admin.extraInfos.show', [$game_user->id, $info->id]) }}"
                           class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.extraInfos.index.delete') }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $infos->links() }}
        </div>
    </div>
@endsection
