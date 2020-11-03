@extends('admin.layouts.layout')

@section('title')
{{ __('lang.role_edit') }}
@endsection

@section('content')
<form action="{{ route('admin.role.edit', ['id' => $role->id]) }}" method="POST">
  @csrf
  @method('put')
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ __('lang.role_info') }}</h3>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('lang.name') }}</label>
            <div class="col-sm-10">
              <input name="name" type="name" class="form-control-plaintext" id="name" value="{{ $role->name }}"/>
            </div>
          </div>

          <div class="form-group row">
            <label for="permissions" class="col-sm-2 col-form-label">{{ __('lang.permissions') }}</label>
            <div class="col-sm-10">
@foreach ($permissions as $index => $permission)
              <div class="form-check">
                <input name="permissions[]" class="form-check-input" type="checkbox" id="permission-{{$index}}" @if ($role->hasPermission($permission->name)) checked @endif value="{{ $permission->id }}">
                <label for="permission-{{$index}}" class="form-check-label">{{ $permission->name }}</label>
              </div>
@endforeach
            </div>
          </div>

        </div><!-- /.card-body -->
      </div><!-- /.card -->
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <a href="{{ route('admin.role') }}" class="btn btn-secondary">{{ __('lang.back') }}</a>
      <button type="submit" class="btn btn-info float-right">{{ __('lang.edit') }}</button>
    </div>
  </div>
</form>
@endsection
