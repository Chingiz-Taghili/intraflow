@extends('admin.layout')

@section('title', 'All Users')

@section('page-plugin-css') @endsection

@section('page-css')

  <link rel="stylesheet" href="{{ asset('datatable/datatables.css') }}" />

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
      <div class="card-header">
        <h4 class="card-title">Multi Filter Select</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="multi-filter-select"
            class="display table table-striped table-hover"
          >
            <thead>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
            </tfoot>
            <tbody>
            <tr>
              <td>Tiger Nixon</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
              <td>2011/04/25</td>
              <td>$320,800</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

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
