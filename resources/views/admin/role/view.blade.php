@extends('admin.layouts.layout')

@section('title')
{{ __('lang.role') . ' #' . $role->id }}
@endsection

@section('content')
<div class="container">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ __('lang.role_info') }}</h3>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>{{ __('lang.id') }}</th>
          <td>{{ $role->id }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.username') }}</th>
          <td>{{ $role->name }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.permissions') }}</th>
          <td>
@foreach ($role->permissions()->orderBy('id')->get() as $permission)
            <div>{{ $permission->name }}</div>
@endforeach
          </td>
        </tr>
        <tr>
          <th>{{ __('lang.created_at') }}</th>
          <td>{{ $role->created_at }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.updated_at') }}</th>
          <td>{{ $role->updated_at }}</td>
        </tr>
      </table>
    </div>
  </div>
  <div>
    <a href="{{ route('admin.role') }}" class="btn btn-secondary">{{ __('lang.back') }}</a>
  </div>
</div>
@endsection
