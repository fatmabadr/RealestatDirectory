<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="favicon.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="/frontend/assets/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="/frontend/assets/fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="/frontend/assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="/frontend/assets/css/aos.css" />
    <link rel="stylesheet" href="/frontend/assets/css/style.css" />

    <title>
      Property &mdash; Free Bootstrap 5 Website Template by Untree.co
    </title>


    <body>
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
              <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
              </div>
            </div>
            <div class="site-mobile-menu-body"></div>
          </div>

          <nav class="site-nav">
            <div class="container">
              <div class="menu-bg-wrap">
                <div class="site-navigation">
                  <a href=" {{route('Units.view.all') }}"class="logo m-0 float-start">Property</a>

                  <ul
                    class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
                  >
                    <li class="active"><a href="{{route('unit.home.page')}}">Home</a></li>
                    <li class="active">
                      <a href="{{route('unit.create')}}"> Sell Property</a>

                    </li>


                    @if (!Auth::user())
                    <li class="active"><a href="{{route('login')}}">Login</a></li>
                    @else
                    <li class="active"><a href="{{route('profile.edit')}}">Profile</a></li>

                    <li class="active">  <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                      </form>
                    </li>
                    @if (Auth::user()->userType==1)
                    <li class="active"><a href="{{route('dashboard')}}">Dashboard</a></li>
                   @endif

                     @endif




                  </ul>


                </div>
              </div>
            </div>
          </nav>
    </body>
  </head>
