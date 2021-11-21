<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Home</title>
</head>

<body>
    <div class="User d-flex ">
        <div class="login-logout col-12">
            @if (auth()->user()==null)
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('login') }}">Log in</a>
            <a id="ViewCart" href="{{ route('ViewCart') }}">Cart <i class="fas fa-shopping-cart"></i></a>
            @else
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Log Out</button>
            </form>
            @endif
            @if (isset($user))
            @if ($number == 0)
            <a id="ViewCart" href="{{ route('ViewCart') }}">Cart <i class="fas fa-shopping-cart"></i></a>
            @else
            <a id="ViewCart" href="{{ route('ViewCart') }}"><i class="fas fa-shopping-cart"></i>({{ $number }})</a>
            @endif
            <a href="">My Account</a>
            @if ($user->Role == 'Admin' || $user->Role == "Moderator")
            <a href="{{route('dashboard')}}">Dashboard</a>
            @endif
            @endif
        </div>
    </div>
    {{-- search bar --}}
    <div id="searchbar">
        <form id="searchform" action="{{ route('Search') }}" method="post">
        @csrf
        <input id="searchtext"class="search-txt" type="text" name="Searched" placeholder="Search for products">
        <div class="vl"></div>
        <a id="searchsubmit" href="">
            <i class="fas fa-search"></i>
        </a>
    </form>
        <ul id="suggestions" class="hidden">
            @if(isset($suggestions))
            @if ($suggestions!==[])
            @foreach ($suggestions as $suggestion)
            <li  class="hidden {{ $suggestion }}">{{ $suggestion }}</li>
            @endforeach
            @endif
            @endif
        </ul>
    </div>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-5 fixed">
        <div class="container-md">
            <a class="navbar-brand svg" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.756 192.756">
                    <g fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="#fff" d="M0 0h192.756v192.756H0V0z" />
                        <path
                            d="M130.424 44.314c6.051-3.026 9.156-2.561 9.234.465.076 3.957-.545 9.233-.934 13.035-2.326 20.64-6.051 37.477-6.361 58.737 10.01-25.916 18.312-43.762 29.098-65.875 3.414-7.061 5.664-5.742 8.457-7.061 10.941-4.889 11.328-1.863 9.854 4.189-5.275 21.959-18.777 91.403-20.871 102.035-.621 3.104-4.035 1.862-4.811.621-4.035-5.354-8.381-5.433-7.916-9.079 2.484-17.69 11.33-62.461 13.58-73.014-11.717 23.897-23.822 53.926-30.027 70.84-1.32 3.57-3.725 3.338-5.199.699-2.174-3.803-6.209-5.664-6.828-10.009-2.174-13.89 2.404-40.426 3.025-57.263-6.285 18.311-16.992 54.004-21.648 70.064-1.939 6.674-8.379 5.51-6.672-.853 7.137-27.08 22.424-74.799 29.018-91.947 1.552-4.11 5.663-3.877 9.001-5.584zM91.783 40.978c-2.096-.465-8.148 2.793-11.872 3.337-1.163.311-2.25 1.474-2.637 2.404C71.375 60.297 66.1 73.179 61.6 84.816a711.997 711.997 0 0 0-20.33 4.035c5.509-13.966 11.019-27.854 16.372-41.124 2.638-6.672-4.344-7.293-7.062-.62-3.491 8.613-10.087 24.828-17.38 43.685-5.354 1.319-11.174 2.793-17.07 4.578-4.345 1.163-4.501 2.326-2.639 4.966 1.086 1.396 3.104 1.241 4.113 2.328 2.561 2.637 4.113 5.819 8.689 6.284-4.189 10.863-8.225 21.959-11.793 32.589-2.328 6.75 4.267 8.147 6.75 1.009 4.035-11.406 8.302-22.967 12.726-34.685 3.647-.775 12.415-2.637 20.562-4.5-6.44 17.846-10.63 31.27-12.338 37.865-.309 1.241.311 1.862.543 2.482 2.096 3.104 4.268 3.259 7.061 7.217.699 1.087 3.259 1.629 4.191-1.009a1241.157 1241.157 0 0 1 17.768-50.279c2.406-.621 6.752-1.63 9.389-5.509 4.656-6.984 5.976-5.586 7.217-7.682 1.396-2.715.387-5.121-4.578-4.578 0 0-1.863.156-5.432.544 5.586-14.2 10.554-26.226 13.967-35.46 1.163-3.181 1.32-5.509-.543-5.974z"
                            fill="#c7232f" />
                        <path
                            d="M86.325 129.153c.807-1.024 1.539-2.081 2.199-3.057 2.94-4.35.078-6.907-2.948-4.346-.432.397-.881.83-1.327 1.28a980.885 980.885 0 0 1-1.477-4.66c1.387-1.7 2.737-3.445 3.889-5.233 4.863-7.542-4.654-11.871-8.768-6.982-2.171 2.561-1.628 5.121-1.008 7.371.18.676.46 1.642.807 2.814a104.967 104.967 0 0 0-4.376 4.866c-4.733 5.433-3.417 12.428 1.552 13.967 2.996.929 5.823-.425 8.272-2.585.118.308.231.601.341.879 1.319 3.259 5.432 2.25 3.802-1.707-.262-.665-.59-1.56-.958-2.607zm-6.736-6.837c.402 1.267.835 2.598 1.267 3.872-.541.451-1.09.907-1.643 1.227-1.924 1.113-3.337-.078-.854-3.414.406-.576.822-1.134 1.23-1.685zm1.553-9.501c-.143-.361-.225-.715-.3-.996-1.392-5.2 4.568-3.811 1.553-.388-.428.485-.817.965-1.253 1.384z"
                            fill="#c7232f" />
                    </g>
                </svg></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active flex-fill px-4" href="#home">Home <span
                            class="sr-only"></span></a>
                    <a class="nav-item nav-link flex-fill px-4 " href="#">Men</a>
                    <a class="nav-item nav-link flex-fill px-4 " href="#">Women</a>
                    <a class="nav-item nav-link flex-fill px-4" href="#">Kids</a>
                    <a class="nav-item nav-link flex-fill px-4" href="#">Sale</a>
                </div>
            </div>
        </div>
    </nav>
    {{-- slider --}}
    <section id="home" class="mb-5">
        <div id="carouselExampleControls" style="margin-top: 20px" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('Images/carousel1jpg.jpg')}}" style="height:800px" class="d-block w-100"  alt="First slide">
                </div>
                <div class="carousel-item">
                    <img style="height:800px" class="d-block w-100" src="{{asset('Images/carousel2jpg.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img style="height:800px" class="d-block w-100" src="{{asset('Images/carousel4.jpg')}}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    {{-- trends --}}
    @if(isset($HomeTrends))
    @if($HomeTrends !== [])
    @if (isset($HomeTrends[0]))
    <section id="trends">
        <div class="container mt-3">
            <div class="d-flex flex-row trends">
                <div class="left d-flex flex-column">
                    <div class="first img bg-dark">
                        <div class="view">View Collection</div>
                        <a href="">
                            <img src="{{$HomeTrends[0]->relative_path}}" alt="">
                        </a>
                    </div>
                    <div class="text mt-2">
                        <h2>Hot Collection</h2>
                        <h1>New trends for {{$HomeTrends[0]->Main_type}}</h1>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos itaque vero sunt iure, autem
                        vitae dolores. Aliquid adipisci, ullam nulla dolorem debitis fuga quasi porro, nesciunt
                        exercitationem ipsa facere error?
                        <br>
                        <button>See more <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                            </svg></button>
                    </div>
                </div>
                @if(isset($HomeTrends[1]))
                <div class="d-flex flex-column trends2">
                    <div class="second img bg-dark">
                        <div class="view">View Collection</div>
                        <a href="">
                            <img src="{{$HomeTrends[1]->relative_path}}" alt="">
                        </a>
                    </div>
                    @endif
                    @if(isset($HomeTrends[2]))
                    <div class="third img bg-dark mt-3">
                        <div class="view">View Collection</div>
                        <a href="">
                            <img src="{{$HomeTrends[2]->relative_path}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            @endif
    </section>
    @endif
    @endif
    @endif
    {{-- browse --}}
    @if(isset($HomeFeatured))
    @if($HomeFeatured!==[])
    @if (isset($HomeFeatured[0]))
    <section id="browse">
        <div class="title">Featured items</div>
        <div class="container">
            <div class="d-flex browser mt-4">
                <p class="All active">All</p>
                <p class="Men">Men</p>
                <p class="Women">Women</p>
                <p class="Kids">Kids</p>
            </div>
            <div class="featured d-flex flex-row flex-wrap mt-5">
                @foreach ($HomeFeatured as $Product)
                <div class="col-3 d-flex flex-column mb-4 {{$Product->Main_type}}">
                    <div class="img bg-dark">
                        <div class="view" style="display: none">
                                <i class="fa fa-eye" style="font-size:50px"></i>
                        </div>
                            <div class="price">
                                <div>${{ $Product->Price }}</div>
                            </div>
                        <a href="">
                            <img src="{{ asset($Product->relative_path) }}" alt="">
                        </a>
                    </div>
                    <div class="text mt-3">
                        <h4>{{$Product->Product_name}}</h4>
                        <button id="{{ $Product->id }}" class="btn btn-success Addtocart">Add to cart</button>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="float-right" href="">View All</a>
        </div>
    </section>
    @endif
    @endif
    @endif
    {{-- Sale --}}
    <div class="Sale d-flex">
        <div class="col-6 px-0">
            <img class="w-100 " src="{{ asset('Images/sale2.jpg') }}" alt="">
        </div>
        <div class="col-6 px-0">
            <img class="w-100 " src="{{ asset('Images/Sale3.jpg') }}" alt="">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
      var addToCart = $('#browse .text .Addtocart');
      var Suggestionvalues = document.querySelectorAll('#suggestions li');
      var Searchtext = document.getElementById('searchtext')
        addToCart.click(function(){
        $.post('/Add/Cart',{
        id:this.id,
        _token:'{{ csrf_token() }}'
        },function(data,status){
            let number = data['response'];
            $('#ViewCart').html('<i class="fas fa-shopping-cart"></i>'+'('+number+')')
        })
    })
    $(document).ready(function(){
        $.post('/Product/Names',{
            _token:'{{ csrf_token() }}'
        },function(data,status){
            var response = data['response']
            Searchtext.addEventListener('keyup',function(){
                var Searchvalue = new RegExp(Searchtext.value);
                var filtered = response.filter(el=>el.match(Searchvalue))
                for (let index = 0; index < Suggestionvalues.length; index++) {
                    Suggestionvalues[index].classList.add('hidden')
                }
                for (let index = 0; index < filtered.length; index++) {
                    var related = document.querySelectorAll('#searchbar #suggestions .'+filtered[index])
                    for (let index = 0; index < related.length; index++) {
                        related[index].classList.remove('hidden')
                    }
                }
            })
        })
    })

    </script>
</body>

</html>
