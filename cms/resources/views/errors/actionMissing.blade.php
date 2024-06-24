@extends('layouts.app')
@section('contents')

<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <!-- page content -->
    <div class="col-md-12">
      <div class="col-middle">
        <div class="text-center text-center">
          <h1 class="error-number">404</h1>
          <h2>Action Route missing</h2>
          <p> set your action route from controller </a>
          </p>
          <div class="mid_center">
            <h3>Search</h3>
            <form>
              <div class="  form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                          <button class="btn btn-secondary" type="button">Go!</button>
                      </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->
  </div>
</div>
@endsection
