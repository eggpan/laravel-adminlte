@extends('admin.layouts.layout')

@section('title')
{{ __('lang.user') . ' #' . $admin->id }}
@endsection

@section('content')
<div class="container">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ __('lang.user_info') }}</h3>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>{{ __('lang.id') }}</th>
          <td>{{ $admin->id }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.email') }}</th>
          <td>{{ $admin->email }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.username') }}</th>
          <td>{{ $admin->username }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.locale') }}</th>
          <td>{{ $admin->locale }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.created_at') }}</th>
          <td>{{ $admin->created_at }}</td>
        </tr>
        <tr>
          <th>{{ __('lang.updated_at') }}</th>
          <td>{{ $admin->updated_at }}</td>
        </tr>
      </table>
    </div>
  </div>
  <div>
    <a href="{{ route('admin.admin') }}" class="btn btn-secondary">{{ __('lang.back') }}</a>
  </div>
</div>
@endsection
