@extends('admin.layouts.layout')

@section('title')
{{ __('lang.user_edit') }}
@endsection

@section('content')
<form action="{{ route('admin.staff.edit', ['id' => $admin->id]) }}" method="POST">
  @csrf
  @method('put')
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ __('lang.user_info') }}</h3>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">{{ __('lang.email') }}</label>
            <div class="col-sm-10">
              <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $admin->email) }}"/>
              <div class="invalid-feedback">
                @error('email') {{ $message }} @enderror
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('lang.username') }}</label>
            <div class="col-sm-10">
              <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="name" value="{{ old('username', $admin->username) }}"/>
              <div class="invalid-feedback">
                @error('username') {{ $message }} @enderror
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="locale" class="col-sm-2 col-form-label">{{ __('lang.locale') }}</label>
            <div class="col-sm-10">
              <select name="locale" class="form-control @error('locale') is-invalid @enderror" id="locale">
                <option value="ja" @if (old('locale', $admin->locale) === 'ja') selected @endif>日本語</option>
                <option value="en" @if (old('locale', $admin->locale) === 'en') selected @endif>English</option>
              </select>
              <div class="invalid-feedback">
                @error('locale') {{ $message }} @enderror
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">{{ __('lang.password') }}</label>
            <div class="col-sm-10">
              <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="new-password"/>
              <div class="invalid-feedback">
                @error('password') {{ $message }} @enderror
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('lang.password_confirmation') }}</label>
            <div class="col-sm-10">
              <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"/>
            </div>
          </div>

        </div><!-- /.card-body -->
      </div><!-- /.card -->
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <a href="{{ route('admin.staff') }}" class="btn btn-secondary">{{ __('lang.back') }}</a>
      <button type="submit" class="btn btn-info float-right">{{ __('lang.edit') }}</button>
    </div>
  </div>
</form>
@endsection
