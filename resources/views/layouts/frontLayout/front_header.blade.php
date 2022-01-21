<!-- SCORRI CATEGORIE DA ELIMINARE -->
<?php /*<div id="cd-nav" class="cd-nav">
    <div class="cd-navigation-wrapper">
        <div class="position-center-center">
            <div class="col-sm-5">

                <!-- Nav -->
                <nav>
                    <ul class="cd-primary-nav">
                        @foreach($categories as $cat)
                        <li class="drop-menu">
                            <a href="#{{$cat->id}}" class="title collapsed" data-toggle="collapse" data-parent="#accoridan">{{$cat->name}}</a></li>
                            <div id="{{$cat->id}}" class="collapse">
                                <div class="well">
                                    <ul>
                                        @foreach($cat->categories as $subcat)
                                        <li>
                                                <a href="{{ asset('products/'.$subcat->url) }}">{{$subcat->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div> */ ?>

<?php
use App\Http\Controllers\Controller;
use App\Product;
$categories = Controller::categories();
$cartCount = Product::cartCount();
?>


<!-- header -->
<header class="header-2">
    <div class="sticky">
        <div class="container-fluid">


            <!-- Logo -->
            <div class="logo"> <a href="{{ asset('/') }}"><img class="img-responsive" src="{{asset ('images/frontend_images/logo4.png')}}" alt="" ></a> </div>
            <nav class="navbar ownmenu">
                <!-- NAV -->

                <div class="collapse navbar-collapse" id="nav-open-btn">
                    <ul class="nav">
                        <li> <a href="{{ asset('/') }}" >Home</a></li>
                        <li class="dropdown"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">Marchi</a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $cat)
                                        <li> <a href="{{ asset('products/'.$cat->url) }}">{{ $cat->name }}
                                            </a>
                                        </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">Categorie</a>
                            <ul class="dropdown-menu">
                                <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="Avventura">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>Avventura
                                            </a>
                                        </li>
                                        </button>
                                </form>
                                <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="Azione">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>Azione
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="Sport">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>Sport
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="Sparatutto">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>Sparatutto
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="Simulazione">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>Simulazione
                                            </a>
                                        </li>
                                    </button>
                                </form>
                            </ul>
                        </li>

                        <li class="dropdown"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">PEGI</a>
                            <ul class="dropdown-menu">
                                <form action="{{url ('/search-products-pegi')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="3">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>3
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products-pegi')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="7">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>7
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products-pegi')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="12">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>12
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products-pegi')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="16">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>16
                                            </a>
                                        </li>
                                    </button>
                                </form>
                                <form action="{{url ('/search-products-pegi')}}" method="post">{{csrf_field()}}
                                    <input hidden type="search" placeholder="Search Product" name="product" value="18">
                                    <button style="background: transparent; border: none" type="submit">
                                        <li> <a>18
                                            </a>
                                        </li>
                                    </button>
                                </form>
                            </ul>
                        </li>

                        <li class="dropdown"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">Console</a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $cat)
                                    @foreach($cat->categories as $subcat)
                                        <?php $productCount = Product::productCount($subcat->id);?>
                                <li> <a href="{{ asset('products/'.$subcat->url) }}">{{ $subcat->name }} ({{$productCount}})
                                    </a>
                                </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>

                        <!-- MEGA MENU -->
                        <li> <a href="{{ url('/orders') }}" >Ordini</a>

                        @if(empty(Auth::check()))
                        <li> <a href="{{url('/login-register')}}"> login</a> </li>
                        @else
                            <li> <a href="{{url('/user-logout')}}"> logout</a> </li>
                        @endif

                    </ul>
                </div>

                <!-- Nav Right -->
                <div class="nav-right">
                    <ul class="navbar-right">

                        <!-- USER INFO -->
                        <li class="dropdown user-acc"> <a href="{{ url('/account') }}" class="dropdown-toggle" role="button" ><i class="icon-user"></i> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <h6></h6>
                                </li>
                                <li><a href="#"></a></li>
                                <li><a href="{{ url('/account') }}">ACCOUNT INFO</a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </li>

                        <!--Wish List-->
                        <li class="dropdown user-acc"> <a href="{{ url('/wish-list') }}" class="dropdown-toggle" role="button" >
                                <i class="fa fa-heart-o"></i> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <h6></h6>
                                </li>
                                <li><a href="#"></a></li>
                                <li><a href="{{ url('/wish-list') }}"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </li>

                        <!-- USER BASKET -->
                        <li class="dropdown user-basket">
                            <a href="{{ url('/cart') }}" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="icon-basket-loaded">
                                    ({{$cartCount}})
                                </i>
                            </a>

                        </li>

                        <!-- SEARCH BAR -->
                        <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                            <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                                <div class="search-overlay"></div>
                                <div class="position-center-center">
                                    <div class="search">
                                        <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                            <input type="search" placeholder="Search Product" name="product">
                                            <button type="submit"><i class="icon-check"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
