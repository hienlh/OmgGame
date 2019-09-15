@extends('admin.layouts.admin')

@section('title', __('views.admin.result_conditions.index.title', ['name' => $result->description]))

@section('content')
    <div class="row">
        <a href="{{ route('admin.conditions.create', [$result->id])  }}" class="btn btn-info btn-xs"><i
                class="fa fa-plus"></i> {{ __('views.admin.create') }} </a>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('views.admin.info_form') }}</th>
                <th>{{ __('views.admin.condition') }}</th>
                <th>{{ __('views.admin.operator') }}</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($conditions as $condition)
                <tr>
                    <td>{{ $condition->info_form->name }}</td>
                    <td>{{ $condition->condition }}</td>
                    <td>{{ $condition->operator }}</td>
                    <td>
                        <a class="btn btn-xs btn-info"
                           href="{{ route('admin.conditions.edit', [$result->id, $condition->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="{{ route('admin.conditions.show', [$result->id, $condition->id]) }}"
                           class="btn btn-xs btn-danger user_destroy" data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.delete') }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $conditions->links() }}
        </div>
    </div>
@endsection
