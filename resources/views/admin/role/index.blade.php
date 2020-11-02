@extends('admin.layouts.layout')

@section('title')
{{ __('lang.role_list') }}
@endsection

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>{{ __('lang.id') }}</th>
            <th>{{ __('lang.name') }}</th>
            <th>{{ __('lang.created_at') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
            <tr>
              <td>{{ $role->id }}</td>
              <td>{{ $role->name }}</td>
              <td>{{ $role->created_at }}</td>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.role.view', ['id' => $role->id]) }}">
                    <i class="fas fa-folder"></i>
                    {{ __('lang.view') }}
                </a>
@can('permission.update')
  @if ($role->id !== 1)
                <a class="btn btn-info btn-sm" href="{{ route('admin.role.edit', ['id' => $role->id]) }}">
                    <i class="fas fa-pencil-alt"></i>
                    {{ __('lang.edit') }}
                </a>
  @else
                <a class="btn btn-info btn-sm disabled" href="#">
                    <i class="fas fa-pencil-alt"></i>
                    {{ __('lang.edit') }}
                </a>
  @endif
@endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div><!-- /.card-body -->
  </div><!-- /.card -->

  {{ $roles->links() }}
</div>
@endsection
