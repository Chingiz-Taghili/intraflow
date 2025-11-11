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

  <div class="card">
    <div class="card-header"><h4 class="card-title">User List</h4></div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
          <div class="row mb-3">
            <div class="col-sm-12 col-md-3">
              <div class="dataTables_length" id="multi-filter-select_length">
                <label>Show <select
                    name="per_page" aria-controls="multi-filter-select"
                    class="filter-input form-control form-control-sm">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                  </select> results</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-3">
              <div class="dataTables_length" id="multi-filter-select_length">
                <label>Department: <select
                    name="department_id" aria-controls="multi-filter-select"
                    class="filter-input form-control form-control-sm">
                    <option value="">All</option>
                    @foreach($departments as $d)
                      <option value="{{ $d->id }}" {{ request('department_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->name }}
                      </option>
                    @endforeach
                  </select></label>
              </div>
            </div>
            <div class="col-sm-12 col-md-3">
              <div class="dataTables_length" id="multi-filter-select_length">
                <label>Role: <select
                    name="role" aria-controls="multi-filter-select"
                    class="filter-input form-control form-control-sm">
                    <option value="">All</option>
                    @foreach($roles as $r)
                      <option value="{{ $r->name }}" {{ request('role') == $r->name ? 'selected' : '' }}>
                        {{ $r->name }}
                      </option>
                    @endforeach
                  </select></label>
              </div>
            </div>
            <div class="col-sm-12 col-md-3">
              <div class="dataTables_length" id="multi-filter-select_length">
                <label>Email Verified: <select
                    name="email_verified" aria-controls="multi-filter-select"
                    class="filter-input form-control form-control-sm">
                    <option value="">All</option>
                    <option value="true" {{ request('email_verified') == 'true' ? 'selected' : '' }}>Verified</option>
                    <option value="false" {{ request('email_verified') == 'false' ? 'selected' : '' }}>Not Verified
                    </option>
                  </select></label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col text-end">
              <form id="search-form" class="d-inline">
                <div id="multi-filter-select_filter" class="dataTables_filter">
                  <label>Search:<input type="search" name="search" value="{{ request('search') }}"
                                       class="form-control form-control-sm" placeholder=""
                                       aria-controls="multi-filter-select">
                  </label>
                  <button type="submit" class="btn btn-sm btn-primary ms-2">Search</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mb-3">
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
          {{ $users->links('vendor.pagination.admin') }}
        </div>
      </div>
    </div>
  </div>

@endsection

@section('page-plugin-js') @endsection

@section('page-js')

  <script>
    // For Filter Selects
    document.querySelectorAll('.filter-input').forEach(el => {
      el.addEventListener('change', () => {
        const params = new URLSearchParams(window.location.search);
        document.querySelectorAll('.filter-input').forEach(input => {
          if (input.value)
            params.set(input.name, input.value);
          else
            params.delete(input.name);
        });
        params.delete('page');
        window.location.search = params.toString();
      });
    });

    // For Search Input
    const searchForm = document.getElementById('search-form');
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const params = new URLSearchParams(window.location.search);
      document.querySelectorAll('.filter-input').forEach(input => {
        if (input.value) params.set(input.name, input.value);
        else params.delete(input.name);
      });
      const searchInput = searchForm.querySelector('input[name="search"]');
      if (searchInput.value) params.set('search', searchInput.value);
      else params.delete('search');
      params.delete('page');
      window.location.search = params.toString();
    });
  </script>
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
