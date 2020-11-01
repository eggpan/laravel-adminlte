@extends('admin.layouts.layout')

@section('title')
{{ __('lang.staff_list') }}
@endsection

@section('content')
<div class="container-fluid">

  <div class="row">
    <div class="col m-2">
      <div class="float-sm-right">
@can('staff.create')
        <a class="btn btn-success btn-sm" href="{{ route('admin.staff.create') }}">
          <i class="fas fa-folder"></i>
          {{ __('lang.create') }}
        </a>
@endcan
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
            <tr @isset ($admin->deleted_at) class="table-danger" @endisset>
              <td>{{ $admin->id }}</td>
              <td>{{ $admin->email }}</td>
              <td>{{ $admin->username }}</td>
              <td>{{ $admin->created_at }}</td>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.staff.view', ['id' => $admin->id]) }}">
                    <i class="fas fa-folder"></i>
                    {{ __('lang.view') }}
                </a>
@can('staff.update')
                <a class="btn btn-info btn-sm" href="{{ route('admin.staff.edit', ['id' => $admin->id]) }}">
                    <i class="fas fa-pencil-alt"></i>
                    {{ __('lang.edit') }}
                </a>
@endcan
@can('staff.delete')
   @isset ($admin->deleted_at)
                <a class="btn btn-default btn-sm" href="{{ route('admin.staff.restore', ['id' => $admin->id]) }}">
                  <i class="fas fa-pencil-alt"></i>
                  {{ __('lang.restore') }}
                </a>
  @else
                <button type="button" class="btn btn-danger btn-sm js-delete-button" data-toggle="modal" data-target="#delete-modal" data-delete-url="{{ route('admin.staff.delete', ['id' => $admin->id]) }}">
                  <i class="fas fa-trash"></i>
                  {{ __('lang.delete') }}
                </button>
  @endisset
@endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div><!-- /.card-body -->
  </div><!-- /.card -->
  {{ $admins->links() }}
</div><!-- /.container-fluid -->

<div class="modal fade" id="delete-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ __('lang.confirmation') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ __('message.confirm_delete') }}</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('lang.cancel') }}</button>
        <form method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">{{ __('lang.delete') }}</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@section('script')
<script>
$('.js-delete-button').on('click', function (e) {
  $('#delete-modal form').attr('action', $(this).data('delete-url'))
})
</script>
@endsection
