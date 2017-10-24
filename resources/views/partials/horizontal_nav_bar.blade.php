<nav class="topBar">
    <div class="container">
        <ul class="list-inline pull-left hidden-sm hidden-xs">
            <li><span class="text-primary">Have a question? </span> Call +120 558 7885</li>
        </ul>
        <ul class="topBarNav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="fa fa-bgn mr-5"></i>BGN<i class="fa fa-angle-down ml-5"></i>
                </a>
                <ul class="dropdown-menu w-100" role="menu">
                    <li><a href="#"><i class="fa fa-eur mr-5"></i>EUR</a>
                    </li>
                    <li class=""><a href="#"><i class="fa fa-usd mr-5"></i>USD</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gbp mr-5"></i>GBP</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                    <img src="http://icons.iconarchive.com/icons/osiris/world-flags/16/00-cctld-bg-icon.png" class="mr-5" alt="">
                    <span class="hidden-xs"> Bulgarian <i class="fa fa-angle-down ml-5"></i></span>
                </a>
                <ul class="dropdown-menu w-100" role="menu">
                    <li>
                        <a href="#"><img src="http://diamondcreative.net/plus-v1.2/img/flags/flag-english.jpg" class="mr-5" alt="">English</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="fa fa-user mr-5"></i><span class="hidden-xs">My Account<i class="fa fa-angle-down ml-5"></i></span> </a>
                <ul class="dropdown-menu w-150" role="menu">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else

                    <li class="divider"></li>
                    <li><a href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="fa fa-shopping-basket mr-5"></i> <span class="hidden-xs">
                                Cart<sup class="text-primary">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</sup>
                                <i class="fa fa-angle-down ml-5"></i>
                            </span> </a>

                <?php
                    if(Session::has('cart'))
                    {
                        $oldCart = Session::get('cart');
                        $cart = new App\Cart($oldCart);
                        $productsCart = $cart->items;
                    }
                ?>

                <ul class="dropdown-menu cart w-250" role="menu">
                    <li>
                        <div class="cart-items">
                            <ol class="items">
                                @if(isset($productsCart))
                                    @foreach($productsCart as $product)
                                        <?php $descriptions = json_decode($product['item']->description, true); ?>

                                        <li>
                                            @if(isset($descriptions['main_picture_url']))
                                                <a href="#" class="product-image"> <img src="{{ $descriptions['main_picture_url'] }}" class="img-responsive" alt="Sample Product "> </a>
                                            @elseif(isset($descriptions['upload_main_picture']))
                                                <a href="#" class="product-image"> <img src="/storage/upload_pictures/{{ $product['item']->id }}/{{ $descriptions['upload_main_picture'] }}" class="img-responsive" alt="Sample Product "> </a>
                                            @else
                                                <a href="#" class="product-image"> <img src="{{ $descriptions['main_picture_url'] }}" class="img-responsive" alt="Sample Product "> </a>
                                            @endif

                                            <div class="product-details">
                                                <div class="close-icon">
                                                    <a href="#"><i class="fa fa-close"></i></a>
                                                </div>
                                                <p class="product-name"> <a href="#">{{ $descriptions['title_product'] }}</a> </p>
                                                <strong>{{ $product['qty']}}</strong> x <span class="price text-primary">{{ $product['price'] }}{{ $descriptions['currency'] }}</span>
                                            </div>
                                            <!-- end product-details -->
                                        </li>
                                    @endforeach

                                @else
                                    <li style="text-align: center;">
                                        <div class="product-details">
                                            <strong>Кошницата е празна</strong>
                                        </div>
                                        <!-- end product-details -->
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </li>
                    <li>
                        <div class="cart-footer">
                            <a href="{{ route('store.shoppingCart') }}" class="pull-left"><i class="fa fa-cart-plus mr-5"></i>ViewCart</a>
                            <a href="#" class="pull-right"><i class="fa fa-shopping-basket mr-5"></i>Checkout</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav><!--=========-TOP_BAR============-->

<!--=========MIDDEL-TOP_BAR============-->

<div class="middleBar">
    <div class="container">
        <div class="row display-table">
            <div class="col-sm-3 vertical-align text-left hidden-xs">
                <a href="javascript:void(0);">Logo <img width="" src="" alt=""></a>
            </div>
            <!-- end col -->
            <div class="col-sm-7 vertical-align text-center">
                <form>
                    <div class="row grid-space-1">
                        <div class="col-sm-6">
                            <input type="text" name="keyword" class="form-control input-lg" placeholder="Search">
                        </div>
                        <!-- end col -->
                        <div class="col-sm-3">
                            <select class="form-control input-lg" name="category">
                                <option value="all">All Categories</option>

                                @foreach($categoriesButtonsName as $categoryButton)
                                    <!-- category-name -->
                                    <optgroup label="{{ $categoryButton->name }}">
                                        <!-- sub category-name -->
                                        @foreach($subCategoriesButtonsName as $subCategoryButton)
                                            @if ($subCategoryButton->category_id == $categoryButton->id)
                                                <option value="{{ $subCategoryButton->name }}">{{ $subCategoryButton->name }}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-default btn-block btn-lg" value="Search">
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </form>
            </div>
            <!-- end col -->
            <div class="col-sm-2 vertical-align header-items hidden-xs">
                <div class="header-item mr-5">
                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="fa fa-heart-o"></i> <sub>32</sub> </a>
                </div>
                <div class="header-item">
                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"> <i class="fa fa-refresh"></i> <sub>2</sub> </a>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end  row -->
    </div>
</div>


<nav class="navbar navbar-main navbar-default" role="navigation" style="opacity: 1;">
    <div class="container">
        <!-- Brand and toggle -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links,  -->
        <div class="collapse navbar-collapse navbar-1" style="margin-top: 0px;">
            <ul class="nav navbar-nav">
                <li class="dropdown megaDropMenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Продукти <i class="fa fa-angle-down ml-5"></i></a>
                    <ul class="dropdown-menu row">
                        @foreach($categoriesButtonsName as $categoryButton)
                            <li class="col-sm-3 col-xs-12">
                                <ul class="list-unstyled">
                                    <li>{{ $categoryButton->name }}</li>
                                    @foreach($subCategoriesButtonsName as $subCategoryButton)
                                        @if ($subCategoryButton->category_id == $categoryButton->id)
                                            <li><a href="#">{{ $subCategoryButton->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Други<i class="fa fa-angle-down ml-5"></i></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Register or Login</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">За нас</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Статии</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Контакти</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>












<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
    ! function($, n, e) {
        var o = $();
        $.fn.dropdownHover = function(e) {
            return "ontouchstart" in document ? this : (o = o.add(this.parent()), this.each(function() {
                function t(e) {
                    o.find(":focus").blur(), h.instantlyCloseOthers === !0 && o.removeClass("open"), n.clearTimeout(c), i.addClass("open"), r.trigger(a)
                }
                var r = $(this),
                        i = r.parent(),
                        d = {
                            delay: 100,
                            instantlyCloseOthers: !0
                        },
                        s = {
                            delay: $(this).data("delay"),
                            instantlyCloseOthers: $(this).data("close-others")
                        },
                        a = "show.bs.dropdown",
                        u = "hide.bs.dropdown",
                        h = $.extend(!0, {}, d, e, s),
                        c;
                i.hover(function(n) {
                    return i.hasClass("open") || r.is(n.target) ? void t(n) : !0
                }, function() {
                    c = n.setTimeout(function() {
                        i.removeClass("open"), r.trigger(u)
                    }, h.delay)
                }), r.hover(function(n) {
                    return i.hasClass("open") || i.is(n.target) ? void t(n) : !0
                }), i.find(".dropdown-submenu").each(function() {
                    var e = $(this),
                            o;
                    e.hover(function() {
                        n.clearTimeout(o), e.children(".dropdown-menu").show(), e.siblings().children(".dropdown-menu").hide()
                    }, function() {
                        var t = e.children(".dropdown-menu");
                        o = n.setTimeout(function() {
                            t.hide()
                        }, h.delay)
                    })
                })
            }))
        }, $(document).ready(function() {
            $('[data-hover="dropdown"]').dropdownHover()
        })
    }(jQuery, this);
</script>