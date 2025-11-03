@extends('admin.layout')

@section('title', 'All Categories')

@section('page-plugin-css') @endsection

@section('page-css') @endsection

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
  <h1>Category index page</h1>
@endsection

@section('page-plugin-js') @endsection

@section('page-js') @endsection
