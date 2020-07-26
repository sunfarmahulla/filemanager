 @extends('layouts/app')
 @section('content')
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
               <!-- Default form login -->
<form class="text-center border border-light p-5" action="{{ route('login') }}" method="post">
@csrf

<p class="h4 mb-4">Sign in</p>

<!-- Email -->
<input type="email" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="E-mail">

<!-- Password -->
<input type="password" id="defaultLoginFormPassword" name="password" class="form-control mb-4" placeholder="Password">

<div class="d-flex justify-content-around">
   
</div>

<!-- Sign in button -->
<button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

<!-- Register -->

</form>
<!-- Default form login --> 
            </div>
        </div>
    </body>
@endsection
