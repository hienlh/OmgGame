@extends('admin.layouts.admin')

@section('title', __('views.admin.infoForms.index.title'))

@section('content')
    <div class="row">
        <a href="{{route('admin.infoForms.create', [$game->id])}}" class="btn btn-info btn-xs"><i
                class="fa fa-plus"></i> {{ __('views.admin.infoForms.index.create') }} </a>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.infoForms.index.table_header_name') }}</th>
                <th>{{ __('views.admin.infoForms.index.table_header_type') }}</th>
                <th>{{ __('views.admin.infoForms.index.table_header_key') }}</th>
                <th>{{ __('views.admin.infoForms.index.table_header_value') }}</th>
                <th>{{ __('views.admin.infoForms.index.table_header_description') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($infoForms as $infoForm)
                <tr>
                    <td>{{ $infoForm->name }}</td>
                    <td>{{ $infoForm->type }}</td>
                    <td>{{ $infoForm->key }}</td>
                    <td>{{ $infoForm->value }}</td>
                    <td>{{ $infoForm->description }}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.infoForms.edit', [$game->id, $infoForm->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.infoForms.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="{{ route('admin.infoForms.show', [$game->id, $infoForm->id]) }}"
                           class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.infoForms.index.delete') }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $infoForms->links() }}
        </div>
    </div>
@endsection
