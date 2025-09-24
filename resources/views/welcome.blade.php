<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('static/item inventory logo.png') }}" />
        <title>ITEM INVENTORY SYSTEM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
    <style>
        html, body {
            background-color: #43362ce6;
            color: #f4f2f2;
            font-family: 'Raleway', sans-serif;
            font-weight: 70;
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
            padding: 20px;
        }

        .title {
            font-size: 84px;
            font-weight: bold;
            line-height: 1.2;
        }

        .links > a {
            color: #f2f3f3;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            display: inline-block;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .links3 a {
            margin-top:50PX;
            text-decoration: none;
            background: #796037;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
            display: inline-block;
        }

        .links3 a:hover {
            background: #7e5c1e;
            transform: scale(1.05);
        }

        .btn-link {
            font-weight: bold;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            background: #5e681ae7;
            color: rgb(16, 2, 2);
            margin: 0 8px;
            transition: background 0.3s, transform 0.2s;
            display: inline-block;
        }

        .btn-link:hover {
            background: #94814aa8;
            transform: scale(1.05);
        }

        /* ✅ Responsive adjustments */
        @media (max-width: 1024px) {
            .title {
                font-size: 60px;
            }

            .links3 a, .btn-link {
                font-size: 14px;
                padding: 10px 20px;
            }
        }

        @media (max-width: 768px) {
            .title {
                font-size: 40px;
            }

            .links3 a, .btn-link {
                font-size: 13px;
                padding: 8px 18px;
            }

            .links > a {
                display: block;
                margin: 10px 0;
            }
        }

        @media (max-width: 480px) {
            .title {
                font-size: 28px;
            }


        @media (max-width: 768px) {
            .links3 a {
                width: 100%;   /* stretch on tablets */
            }
        }

        @media (max-width: 480px) {
            .links3 a {
                width: auto;          /* shrink back on small phones */
                display: inline-block;
                margin: 10px auto;
            }
        }


            /* ✅ Login/Register stay compact */
            .btn-link {
                width: auto;
                display: inline-block;
                margin: 5px;
            }
        }
    </style>


    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}" class="btn-link">Login</a>
                    <a href="{{ url('/register') }}" class="btn-link">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ITEM INVENTORY SYSTEM
                </div>
                <div class="links3">
                    <a href="dashboard">Explore Inventory</a>
                </div>
            </div>

        </div>
        </div>
    </body>
</html>
