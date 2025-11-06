@extends('admin.layout')

@section('title', 'All Users')

@section('page-plugin-css') @endsection

@section('page-css')

  <link rel="stylesheet" href="{{ asset('datatable/datatables.css') }}"/>

@endsection

@section('search')
  <div class="input-group">
    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
      <span class="input-group-text" id="search"><i class="icon-search"></i></span>
    </div>
    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
           aria-label="search" aria-describedby="search">
  </div>
@endsection

@section('content')

  {{--<div class="card">
    <div class="card-header"><h4 class="card-title">Multi Filter Select</h4></div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="multi-filter-select" class="display table table-striped table-hover">
          <thead>
          <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Department</th>
            <th>Roles</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Department</th>
            <th>Roles</th>
          </tr>
          </tfoot>
          <tbody>
          @forelse($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->surname }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->department->name ?? '-' }}</td>
              <td>{{ $user->getRoleNames()->join(', ') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No users found</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>--}}

  <div class="card">
    <div class="card-header"><h4 class="card-title">Multi Filter Select</h4></div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="multi-filter-select_length"><label>Show <select
                    name="multi-filter-select_length" aria-controls="multi-filter-select"
                    class="form-control form-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> entries</label></div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div id="multi-filter-select_filter" class="dataTables_filter">
                <label>Search:<input type="search"
                                     class="form-control form-control-sm" placeholder="" aria-controls="multi-filter-select">
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table id="multi-filter-select" class="display table table-striped table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Roles</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Roles</th>
                </tr>
                </tfoot>
                <tbody>
                @forelse($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department->name ?? '-' }}</td>
                    <td>{{ $user->getRoleNames()->join(', ') }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center">No users found</td>
                  </tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-5">
              <div class="dataTables_info" id="multi-filter-select_info" role="status" aria-live="polite">
                Showing 1 to 10 of 15 entries
              </div>
            </div>
            <div class="col-sm-12 col-md-7">
              <div class="dataTables_paginate paging_simple_numbers" id="multi-filter-select_paginate">
                {{--<ul class="pagination">
                  <li class="paginate_button page-item previous disabled" id="multi-filter-select_previous">
                    <a href="#"
                       aria-controls="multi-filter-select" data-dt-idx="0" tabindex="0" class="page-link">
                      Previous</a>
                  </li>
                  <li class="paginate_button page-item active">
                    <a href="#" aria-controls="multi-filter-select" data-dt-idx="1"
                       tabindex="0" class="page-link">1</a></li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="multi-filter-select" data-dt-idx="2"
                       tabindex="0" class="page-link">2</a></li>
                  <li class="paginate_button page-item next" id="multi-filter-select_next">
                    <a href="#" aria-controls="multi-filter-select" data-dt-idx="3" tabindex="0"
                       class="page-link">Next</a></li>
                </ul>--}}
                {{ $users->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{--<div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="dataTables_length" id="multi-filter-select_length"><label>Show <select
              name="multi-filter-select_length" aria-controls="multi-filter-select"
              class="form-control form-control-sm">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select> entries</label></div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div id="multi-filter-select_filter" class="dataTables_filter">
          <label>Search:<input type="search"
            class="form-control form-control-sm" placeholder="" aria-controls="multi-filter-select">
          </label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="multi-filter-select_info" role="status" aria-live="polite">
          Showing 1 to 10 of 15 entries
        </div>
      </div>
      <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="multi-filter-select_paginate">
          <ul class="pagination">
            <li class="paginate_button page-item previous disabled" id="multi-filter-select_previous">
              <a href="#"
                 aria-controls="multi-filter-select" data-dt-idx="0" tabindex="0" class="page-link">
                Previous</a>
            </li>
            <li class="paginate_button page-item active">
              <a href="#" aria-controls="multi-filter-select" data-dt-idx="1"
                 tabindex="0" class="page-link">1</a></li>
            <li class="paginate_button page-item ">
              <a href="#" aria-controls="multi-filter-select" data-dt-idx="2"
                 tabindex="0" class="page-link">2</a></li>
            <li class="paginate_button page-item next" id="multi-filter-select_next">
              <a href="#" aria-controls="multi-filter-select" data-dt-idx="3" tabindex="0"
                 class="page-link">Next</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>--}}

@endsection

@section('page-plugin-js') @endsection

@section('page-js')

  <script src="{{ asset('datatable/datatables.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $("#multi-filter-select").DataTable({
        pageLength: 10,
        initComplete: function () {
          this.api().columns().every(function () {
            var column = this;
            var select = $('<select class="form-select"><option value=""></option></select>')
              .appendTo($(column.footer()).empty())
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? "^" + val + "$" : "", true, false).draw();
              });
            column.data().unique().sort().each(function (d, j) {
              select.append('<option value="' + d + '">' + d + "</option>");
            });
          });
        },
      });
    });
  </script>

@endsection
