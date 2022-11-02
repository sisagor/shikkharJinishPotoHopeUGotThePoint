<!doctype html>
<html lang="en">
<head>
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login/style.css')}}">
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 col-lg-10">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong> {{ session('status') }} </strong>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong> {{ $errors->first() }} </strong>
                    </div>
                @endif
            </div>

            <div class="col-md-12 col-lg-10 col-sm-12 col-12">
                <div class="wrap d-md-flex">
                    <div class="img">
                        <img src=" {{ get_storage_file_url((\App\Models\SystemSetting::select('login_image')->first())->login_image) }}" alt="Login page image">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">{{config('app.name')}}</h3>
                            </div>
                        </div>

                        @yield('content')

                    </div>
                </div>

                @if(config('app.demo') && request()->is('login'))

                    <div class="wrap d-md-flex mt-1">
                        <div class="col-md-12 col-sm-12 text-center">
                            <div class="box login-box-body mt-2">
                                <div class="box-header with-border">
                                    <h6 class="box-title">Demo Login::</h6>
                                </div> <!-- /.box-header -->
                                <div class="box-body font12">
                                    <div class="col-md-6 col-sm-6 pull-left">
                                        <p><strong>ADMIN::</strong>Email: <strong>admin@demo.com</strong> | Password: <strong>123456</strong> </p>
                                        <p><strong>COMPANY::</strong>Email: <strong>company@demo.com</strong> | Password: <strong>123456</strong> </p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 pull-right">
                                        <p><strong>BRANCH::</strong> Email: <strong>branch@demo.com</strong> | Password: <strong>123456</strong> </p>
                                        <p><strong>EMPLOYEE::</strong> Email: <strong>employee0@demo.com</strong> | Password: <strong>123456</strong> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/login/jquery.min.js')}}"></script>
<script src="{{asset('js/login/popper.js')}}"></script>
<script src="{{asset('js/login/bootstrap.min.js')}}"></script>
<script src="{{asset('js/login/main.js')}}"></script>

</body>
</html>

