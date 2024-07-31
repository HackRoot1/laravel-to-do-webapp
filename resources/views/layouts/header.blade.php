<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="{{ asset('./assets/css/registration.css') }}">
    
    <!-- ===== Iconscout CSS ====== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    

    <!-- ======== jquery link ========= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <title>Dashboard</title>
</head>
<body>
    
    <nav>
        <div class="logo-name">
            <div class = "logo-image">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <span class="logo_name">To&nbsp;Do&nbsp;App</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="{{ route('account.profile') }}">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.add.task') }}">
                        <i class="uil uil-plus-circle"></i>
                        <span class="link-name">Add&nbsp;Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.view.task') }}">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">View&nbsp;Tasks</span>
                    </a>
                </li>

            </ul>

            <ul class="logout-mode">
                <li>
                    <a href="{{ route('account.logout') }}">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
                <li class = "mode">
                    <a href="">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>



    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" id = "global-search" class="input-values" placeholder="Search here....">
            </div>
            <div id = "model-open">
                <div>
                    {{ Auth::user()->username }}
                </div>
                @if(Auth::user()->profile != "")
                    <img src="{{ asset('uploads/' .Auth::user()->profile) }}">
                @else 
                    <img src="{{ asset('uploads/profile.png') }}">                    
                @endif
                <i class="uil uil-angle-down"></i>
            </div>
        </div>
        <div id="model-box">
            <a href = "{{ route('account.settings') }}">Settings</a>
        </div>
        
        @yield('main')

    </section>


    <!-- ======= external js link ======== -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <!-- ======== jquery link ========= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- ajax code -->
        <script>
        $(document).ready(function(){

            // closing popup box
            $(document).on("click",".close-btn", function(){
                $("#model").hide();
            });

            // setting button for profile page
            $("#model-box").hide();
            $("#model-open").on("click", function(){
                $("#model-box").fadeToggle();
            });

            
            // =============== sorting ===========
            $("#select-sort-options").hide();
            
            $("#sort-btn").on("click", function(){
                $("#select-sort-options").fadeToggle();
            });
            
            $("#select-sort-options").on("change", function(){
                $(this).fadeOut();
            });
            // =============== end sorting ===========
            
            setInterval(function() {
                $('#result-data').slideUp();
            }, 5000);
        });
    </script>
</body>
</html>