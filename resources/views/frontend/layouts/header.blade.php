<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Toy Store</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<!-- HEADER WRAPPER -->
<header class="custom-header">
    <!-- TOP HEADER -->
    <div class="top-header">
        <div class="container">
            <div class="header-top-content">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('frontend/img/toy-logo.png') }}" alt="Logo" />
                    </a>
                </div>

                <!-- Mobile Hamburger Icon -->
                <div class="mobile-menu-icon" onclick="toggleMobileMenu()">
                    <i class="fa fa-bars"></i>
                </div>

                <!-- Search Bar + Brand Icons -->
                <div class="search-section">
                    <div class="search-box">
                        <input type="text" placeholder="Search" />
                        <button><i class="fa fa-search"></i></button>
                    </div>
                    <div class="brand-icons">
                        <img class="brand-button" data-brand-id="3" src="https://images.bigbadtoystore.com/site-images/transformers-button2.png" alt="Transformers" />
                        <img class="brand-button" data-brand-id="5" src="https://images.bigbadtoystore.com/site-images/dc-button5.png" alt="DC" />
                        <img class="brand-button" data-brand-id="7" src="https://images.bigbadtoystore.com/site-images/marvel-button3.png" alt="Marvel" />
                        <img class="brand-button" data-brand-id="6" src="https://images.bigbadtoystore.com/site-images/starwars-button4.png" alt="Star Wars" />
                        <a href="{{ url('product-search') }}" class="more-button-styled">
                            More <span class="arrow">→</span>
                        </a>
                    </div>
                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.querySelectorAll(".brand-button").forEach(btn => {
                            btn.addEventListener("click", function () {
                                const brandId = this.getAttribute("data-brand-id");

                                // Start with product-search URL
                                const url = new URL("{{ route('product-search') }}", window.location.origin);

                                // If we are already on product-search, preserve existing query params
                                if (window.location.pathname.includes("product-search")) {
                                    const currentParams = new URLSearchParams(window.location.search);
                                    currentParams.forEach((value, key) => {
                                        url.searchParams.append(key, value);
                                    });
                                }

                                // Add/append brand filter
                                url.searchParams.append("brands[]", brandId);

                                // Redirect
                                window.location.href = url.toString();
                            });
                        });
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- MOBILE HEADER -->
    <div class="mobile-header-wrapper">
        <div class="mobile-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('frontend/img/toy-logo.png') }}" alt="Logo" />
            </a>
        </div>

        <div class="mobile-search">
            <div class="search-container">
                <input type="text" placeholder="Search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>

        <div class="mobile-nav-bar">
            <div class="menu-left" onclick="toggleMobileMenu()">
                <i class="fa fa-bars"></i> MENU
            </div>
            <div class="menu-right">
              <a href="{{ url('account') }}">My Account</a>
              <a href="{{ url('help') }}">Help</a>
              <a href="{{ url('cart') }}" class="cart-link">
                  <i class="fa fa-shopping-cart"></i> Cart
                  @php
                      use App\Models\Cart;
                      $cartCount = Cart::where('user_id', auth()->id())->whereNull('order_id')->sum('quantity');
                  @endphp
                  @if($cartCount > 0)
                      <span class="cart-count">{{ $cartCount }}</span>
                  @endif
              </a>
          </div>
        </div>
    </div>

    <!-- MOBILE DROPDOWN -->
    <div class="mobile-dropdown" id="mobileDropdown">
        <!-- Example submenu -->
        <div class="mobile-menu-item">
            <button class="mobile-menu-toggle" onclick="toggleSubMenu('bestSellersSub')">Best Sellers <span>+</span></button>
            <div class="mobile-submenu" id="bestSellersSub">
                <div class="mobile-sub-col">
                                <span class="dropdown-title">BRANDS</span>
                                <ul>
                                    <a href="{{ url('product-search?brands[]=1') }}"><li>One Piece</li></a>
                                    <a href="{{ url('product-search?brands[]=3') }}"><li>Transformers</li></a>
                                    <a href="{{ url('product-search?brands[]=4') }}"><li>Disney</li></a>
                                    <a href="{{ url('product-search?brands[]=10') }}"><li>Nickelodeon</li></a>
                                    <a href="{{ url('product-search?brands[]=8') }}"><li>Nintendo</li></a>
                                    <a href="{{ url('product-search?brands[]=2') }}"><li>Gundam</li></a>
                                </ul>
                            </div>
                            
                            <div class="dropdown-col">
                                <span class="dropdown-title">PRODUCT TYPE</span>
                                <ul>
                                    <a href="{{ url('product-search?product_types[]=1') }}"><li>Static Figures</li></a>
                                    <a href="{{ url('product-search?product_types[]=2') }}"><li>Action Figures</li></a>
                                    <a href="{{ url('product-search?product_types[]=3') }}"><li>Transforming Figures</li></a>
                                    <a href="{{ url('product-search?product_types[]=4') }}"><li>Replicas</li></a>
                                    <a href="{{ url('product-search?product_types[]=5') }}"><li>Busts</li></a>
                                    <a href="{{ url('product-search?product_types[]=6') }}"><li>Plush</li></a>
                                </ul>
                            </div>

                            <div class="dropdown-col">
                                <span class="dropdown-title">SERIES</span>
                                <ul>
                                    <a href="{{ url('product-search?series[]=4') }}"><li>Tamashii Nations</li></a>
                                    <a href="{{ url('product-search?series[]=5') }}"><li>Marvel Legends</li></a>
                                    <a href="{{ url('product-search?series[]=6') }}"><li>Ichibansho</li></a>
                                    <a href="{{ url('product-search?series[]=1') }}"><li>Pop!</li></a>
                                    <a href="{{ url('product-search?series[]=2') }}"><li>Exclusives</li></a>
                                    <a href="{{ url('product-search?series[]=3') }}"><li>Nendoroid</li></a>
                                </ul>
                            </div>

                            <div class="dropdown-col">
                                <span class="dropdown-title">BBTS PICKS</span>
                                <ul>
                                    <a href="{{ url('product-search?companies[]=1') }}"><li>Funko</li></a>
                                    <a href="{{ url('product-search?companies[]=22') }}"><li>Bandai Spirits</li></a>
                                    <a href="{{ url('product-search?companies[]=24') }}"><li>Hasbro</li></a>
                                    <a href="{{ url('product-search?companies[]=27') }}"><li>McFarlane Toys</li></a>
                                    <a href="{{ url('product-search?companies[]=28') }}"><li>Mattel</li></a>
                                    <a href="{{ url('product-search?companies[]=26') }}"><li>Super7</li></a>
                                </ul>
                            </div>
                <!-- Repeat for other columns -->
            </div>
        </div>

        <a href="{{ url('featuredpreorders') }}">Featured Pre-orders</a>
        <a href="{{ url('newarrivals') }}">New Arrivals</a>
        <a href="{{ url('sale') }}">Sale Items</a>
    </div>

    <!-- DESKTOP NAV -->
    <div class="bottom-nav">
        <div class="container">
            <div class="nav-left" style="margin-left: -400px;">
                <div style="position: relative; display: inline-block;">
                    <a href="javascript:void(0);" class="dropdown-toggle" style="color: #fff; padding: 14px 16px; text-decoration: none; font-weight: 600;">Best Sellers ⮟</a>
                    <div class="custom-dropdown-menu">
                        <div class="dropdown-columns">
                            <div class="dropdown-col">
                                <span class="dropdown-title">BRANDS</span>
                                <ul>
                                    <a href="{{ url('product-search?brands[]=1') }}"><li>One Piece</li></a>
                                    <a href="{{ url('product-search?brands[]=3') }}"><li>Transformers</li></a>
                                    <a href="{{ url('product-search?brands[]=4') }}"><li>Disney</li></a>
                                    <a href="{{ url('product-search?brands[]=10') }}"><li>Nickelodeon</li></a>
                                    <a href="{{ url('product-search?brands[]=8') }}"><li>Nintendo</li></a>
                                    <a href="{{ url('product-search?brands[]=2') }}"><li>Gundam</li></a>
                                </ul>
                            </div>
                            
                            <div class="dropdown-col">
                                <span class="dropdown-title">PRODUCT TYPE</span>
                                <ul>
                                    <a href="{{ url('product-search?product_types[]=1') }}"><li>Static Figures</li></a>
                                    <a href="{{ url('product-search?product_types[]=2') }}"><li>Action Figures</li></a>
                                    <a href="{{ url('product-search?product_types[]=3') }}"><li>Transforming Figures</li></a>
                                    <a href="{{ url('product-search?product_types[]=4') }}"><li>Replicas</li></a>
                                    <a href="{{ url('product-search?product_types[]=5') }}"><li>Busts</li></a>
                                    <a href="{{ url('product-search?product_types[]=6') }}"><li>Plush</li></a>
                                </ul>
                            </div>

                            <div class="dropdown-col">
                                <span class="dropdown-title">SERIES</span>
                                <ul>
                                    <a href="{{ url('product-search?series[]=4') }}"><li>Tamashii Nations</li></a>
                                    <a href="{{ url('product-search?series[]=5') }}"><li>Marvel Legends</li></a>
                                    <a href="{{ url('product-search?series[]=6') }}"><li>Ichibansho</li></a>
                                    <a href="{{ url('product-search?series[]=1') }}"><li>Pop!</li></a>
                                    <a href="{{ url('product-search?series[]=2') }}"><li>Exclusives</li></a>
                                    <a href="{{ url('product-search?series[]=3') }}"><li>Nendoroid</li></a>
                                </ul>
                            </div>

                            <div class="dropdown-col">
                                <span class="dropdown-title">BBTS PICKS</span>
                                <ul>
                                    <a href="{{ url('product-search?companies[]=1') }}"><li>Funko</li></a>
                                    <a href="{{ url('product-search?companies[]=22') }}"><li>Bandai Spirits</li></a>
                                    <a href="{{ url('product-search?companies[]=24') }}"><li>Hasbro</li></a>
                                    <a href="{{ url('product-search?companies[]=27') }}"><li>McFarlane Toys</li></a>
                                    <a href="{{ url('product-search?companies[]=28') }}"><li>Mattel</li></a>
                                    <a href="{{ url('product-search?companies[]=26') }}"><li>Super7</li></a>
                                </ul>
                            </div>
                            <!-- Repeat for other columns -->
                            <div class="dropdown-col dropdown-image-col">
                                <img src="https://images.bigbadtoystore.com/ads/p/mm19.png" alt="Dropdown Promo" style="max-width: 300px; border-radius: 4px;">
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('featuredpreorders') }}" style="font-weight: 600;">Featured Pre-orders</a>
                <a href="{{ url('newarrivals') }}" style="font-weight: 600;">New Arrivals</a>
                <a href="{{ url('sale') }}" style="font-weight: 600;">Sale Items</a>
            </div>
            <div class="nav-right" style="margin-right: -400px;">
                <a href="{{ url('account') }}">My Account</a>
                <a href="{{ url('help') }}">Help</a>
                <a href="{{ url('cart') }}" class="cart-link">
                    <i class="fa fa-shopping-cart"></i> Cart
                    @php
                        $cartCount = Cart::where('user_id', auth()->id())->whereNull('order_id')->sum('quantity');
                    @endphp
                    @if($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        document.getElementById("mobileDropdown").classList.toggle("active");
    }

    function toggleSubMenu(id) {
        document.getElementById(id).classList.toggle("active");
    }
</script>

<!-- Include same <style> block here or move to CSS file -->
<style>
.mobile-menu-icon {
  display: none;
  font-size: 24px;
  cursor: pointer;
  color: #333;
  margin-left: auto;
}

.mobile-dropdown {
  display: none;
  background: #f9f9f9;
  padding: 10px 15px;
  flex-direction: column;
}

.mobile-dropdown.active {
  display: flex;
  flex-direction: column;
}

.mobile-dropdown a,
.mobile-menu-toggle {
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
  color: #333;
  text-decoration: none;
  font-weight: 600;
  background: none;
  border: none;
  text-align: left;
  width: 100%;
}

.mobile-submenu {
  display: none;
  padding-left: 15px;
  margin-top: 10px;
}

.mobile-submenu.active {
  display: block;
}

.mobile-sub-col {
  margin-bottom: 10px;
}

.mobile-sub-col strong {
  display: block;
  margin-bottom: 5px;
}

.mobile-sub-col ul {
  list-style: none;
  padding-left: 0;
}

.mobile-sub-col ul li {
  padding: 5px 0;
  font-size: 14px;
}

@media (max-width: 768px) {
  .bottom-nav {
    display: none;
  }

  .mobile-menu-icon {
    display: block;
  }

  .search-section {
    flex-direction: column;
    align-items: flex-start;
  }

  .brand-icons {
    flex-wrap: wrap;
    justify-content: flex-start;
  }
    .search-section {
    display: none;
  }
}
/* HIDE ON DESKTOP, SHOW ON MOBILE */
.mobile-header-wrapper {
  display: none;
}

@media (max-width: 768px) {
  .mobile-header-wrapper {
    display: block;
    background: #fff;
  }

  .mobile-logo {
    text-align: center;
    padding: 10px 0;
  }

  .mobile-logo img {
    max-width: 160px;
    height: auto;
  }

  .mobile-search {
    padding: 0 12px 10px;
  }

  .search-container {
    position: relative;
    width: 100%;
  }

  .search-container input {
    width: 100%;
    padding: 8px 40px 8px 12px;
    border: 2px solid #d32f2f;
    font-size: 14px;
    border-radius: 4px;
  }

  .search-container button {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: #d32f2f;
    font-size: 18px;
    cursor: pointer;
  }

  .mobile-nav-bar {
    display: flex;
    justify-content: space-between;
    background-color: #c62828;
    color: #fff;
    padding: 10px 12px;
    font-weight: bold;
    font-size: 14px;
  }

  .mobile-nav-bar a {
    color: #fff;
    text-decoration: none;
    margin: 0 5px;
  }

  .menu-left,
  .menu-center,
  .menu-right {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .menu-left {
    cursor: pointer;
  }

  /* Hide desktop header on mobile */
  .top-header,
  .bottom-nav {
    display: none !important;
  }
}
.cart-link {
    position: relative;
    display: inline-block;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -12px;
    background: red;
    color: white;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 50%;
}
/* Container styling */
.custom-dropdown-menu {
    position: absolute;
    top: 155%;
    left: 12px;
    background: #ffffff;
    border-radius: 6px;
    padding: 20px 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    min-width: 900px;
    z-index: 999;
    display: none; /* initially hidden; show on hover from parent */
}

/* Columns wrapper */
.dropdown-columns {
    display: flex;
    gap: 40px;
    flex-wrap: nowrap;
}

/* Each column */
.dropdown-col {
    min-width: 180px;
}

/* Titles */
.dropdown-title {
    display: block;
    font-weight: bold;
    font-size: 14px;
    letter-spacing: 0.5px;
    color: #333;
    margin-bottom: 10px;
    text-transform: uppercase;
    border-bottom: 2px solid #eee;
    padding-bottom: 5px;
}

/* Lists */
.dropdown-col ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.dropdown-col ul li {
    padding: 6px 0;
    font-size: 14px;
    transition: all 0.2s ease-in-out;
    color: #444;
}

.dropdown-col ul li:hover {
    color: #d32f2f; /* highlight color */
    transform: translateX(4px);
}

/* Link styling */
.dropdown-col ul a {
    text-decoration: none;
    color: inherit;
    display: block;
}

/* Image column */
.dropdown-image-col {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dropdown-image-col img {
    max-width: 300px;
    border-radius: 6px;
    transition: transform 0.3s ease;
}

.dropdown-image-col img:hover {
    transform: scale(1.03);
}

/* Show on hover */
.nav-item:hover .custom-dropdown-menu {
    display: block;
}
</style>
