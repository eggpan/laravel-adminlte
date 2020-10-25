@extends('admin.layouts.layout')

@section('title')
{{ __('lang.user_list') }}
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col m-2">
      <div class="float-sm-right">
        <a class="btn btn-success btn-sm" href="{{ route('admin.admin.create') }}">
          <i class="fas fa-folder"></i>
          {{ __('lang.create') }}
        </a>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>{{ __('lang.id') }}</th>
            <th>{{ __('lang.email') }}</th>
            <th>{{ __('lang.username') }}</th>
            <th>{{ __('lang.created_at') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($admins as $admin)
            <tr>
              <td>{{ $admin->id }}</td>
              <td>{{ $admin->email }}</td>
              <td>{{ $admin->username }}</td>
              <td>{{ $admin->created_at }}</td>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-folder"></i>
                    {{ __('lang.view') }}
                </a>
                <a class="btn btn-info btn-sm" href="#">
                    <i class="fas fa-pencil-alt"></i>
                    {{ __('lang.edit') }}
                </a>
                <a class="btn btn-danger btn-sm" href="#">
                    <i class="fas fa-trash"></i>
                    {{ __('lang.delete') }}
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div><!-- /.card-body -->
  </div><!-- /.card -->
</div><!-- /.container-fluid -->
@endsection
