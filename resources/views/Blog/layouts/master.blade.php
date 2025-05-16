<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Personal Blog</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@100;600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    {{--
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('BlogTem/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('BlogTem/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('BlogTem/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="{{ asset('BlogTem/css/style.css') }}" rel="stylesheet">
</head>
<!-- Add this style block or move to your CSS file -->
<style>
    .btn-group:hover .dropdown-menu {
        display: block;
        top: 100% !important;
        /* Ensures it's below the button */
        margin-top: 0.25rem;
        /* Small space between icon and menu */
    }
</style>

{{-- Shake effect article image --}}
<style>
    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        20% {
            transform: translateX(-5px);
        }

        40% {
            transform: translateX(5px);
        }

        60% {
            transform: translateX(-5px);
        }

        80% {
            transform: translateX(5px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .shake-effect:hover {
        animation: shake 0.5s;
    }
</style>




<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    {{-- <div id="spinner"
        class="d-none w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        --}}

        <!-- Spinner End -->



        <!-- Navbar start -->
        <div class="container-fluid sticky-top px-0">
            <div class="container-fluid topbar bg-dark d-none d-lg-block">
                <div class="container px-0">
                    <div class="topbar-top d-flex justify-content-between flex-lg-wrap">
                        <div class="top-info flex-grow-0">
                            <span class="rounded-circle btn-sm-square bg-primary me-2">
                                <i class="fas fa-bolt text-white"></i>
                            </span>
                            <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
                                <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
                            </div>
                            <div class="overflow-hidden" style="max-width: 735px; width: 100%;">
                                <div id="note" class="ps-2">
                                    <img src="{{ asset('BlogTem/img/features-fashion.jpg') }}"
                                        class="img-fluid rounded-circle border border-3 border-primary me-2"
                                        style="width: 30px; height: 30px;" alt="">
                                    <a href="#">
                                        <p class="text-white mb-0 link-hover">
                                            မျိုးစေ့ကို မစိုက်ပျိုးဘဲ အသီးအပွင့်ကို မရရှိနိုင်။
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="top-link flex-lg-wrap d-flex align-items-center">
                            <i class="fas fa-calendar-alt text-white border-end border-secondary mx-1"></i>
                            <span id="current-date" class="text-white ms-2"></span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container-fluid bg-light">
                <div class="container px-0">
                    <nav class="navbar navbar-light navbar-expand-xl">
                        <a href="index.html" class="navbar-brand mt-3">


                            <p class="text-primary display-6 mb-2" style="line-height: 5px;">Future</p>
                            <small class="text-body fw-normal" style="letter-spacing: 12px;">Light</small>
                        </a>
                        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse">
                            <span class="fa fa-bars text-primary"></span>
                        </button>
                        <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                            <div class="navbar-nav mx-auto border-top">
                                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                                <a href="index.html" class="nav-item nav-link ">Categories</a>



                                <a href="contact.html" class="nav-item nav-link">About</a>
                            </div>

                            @php
                            $notifications = [];
                            $unreadCount = 0;

                            if (auth()->check()) {
                            $notifications = auth()
                            ->user()
                            ->notifications()
                            ->where('created_at', '>=', now()->subDays(7))
                            ->latest()
                            ->limit(10)
                            ->get();

                            $unreadCount = auth()
                            ->user()
                            ->unreadNotifications()
                            ->where('created_at', '>=', now()->subDays(7))
                            ->count();
                            }

                            function getNotiIcon($type)
                            {
                            return match ($type) {
                            'loved' => '❤️',
                            'commented' => '💬',
                            'viewed' => '👁️',
                            'saved' => '🔖',
                            'published' => '📝',
                            default => '🔔',
                            };
                            }
                            @endphp



                            <div class="dropdown mx-3">
                                <button type="button"
                                    class="btn btn-outline-dark rounded-circle border-dark position-relative"
                                    id="notiBell" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="width: 48px; height: 48px;">
                                    <i class="fa-solid fa-bell fa-lg"></i>

                                    @if ($unreadCount > 0)
                                    <span id="notiBadge"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                    </span>
                                    @endif
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow-lg p-2"
                                    style="width: 360px; max-height: 420px; overflow-y: auto;">

                                    <li class="px-2 d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-semibold">Notifications</span>
                                        <button type="button" id="markAllUnread" class="btn btn-sm btn-link">↩️ Mark
                                            all as
                                            unread</button>

                                    </li>
                                    <hr class="my-1">

                                    @foreach ($notifications as $index => $notification)
                                    @php
                                    $type = $notification->data['type'] ?? 'default';
                                    $isHidden = $index >= 10;
                                    @endphp
                                    <li class="mb-2 noti-item {{ $isHidden ? 'd-none more-noti' : '' }}">
                                        <div
                                            class="dropdown-item d-flex gap-3 p-2 rounded {{ $notification->read_at ? 'text-muted' : 'fw-semibold bg-light' }}">
                                            <div class="fs-4">{{ getNotiIcon($type) }}</div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <span class="d-block">{{ $notification->data['actor_name'] ??
                                                        'Someone' }}
                                                        {{ $notification->data['type'] }}</span>
                                                    <strong>{{ Str::limit($notification->data['title'], 30) }}</strong>
                                                </div>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans()
                                                    }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach


                                    @if ($notifications->count() >= 10)
                                    <hr>
                                    <li class="text-center mt-2">
                                        <button id="showAllNoti" class="btn btn-outline-dark">
                                            <i class="bi bi-bell"></i> Show All Notifications
                                        </button>
                                    </li>
                                    @endif


                                </ul>
                            </div>
                        <div class="d-flex align-items-center">





                                <!-- Your button group -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-user fa-lg"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('profile.Page') }}">Profile</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('profile.creatorStudioPage') }}">Creator
                                                Studio</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li class="d-flex justify-content-center">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger text-center">Log
                                                    out</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>


                            </div>



                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords"
                                aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        @yield('content')






        <!-- Footer Start -->
        <div class="container-fluid bg-dark footer py-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#" class="d-flex flex-column flex-wrap">
                                <p class="text-white mb-0 display-6">Newsers</p>
                                <small class="text-light"
                                    style="letter-spacing: 11px; line-height: 0;">Newspaper</small>
                            </a>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex position-relative rounded-pill overflow-hidden">
                                <input class="form-control border-0 w-100 py-3 rounded-pill" type="email"
                                    placeholder="example@gmail.com">
                                <button type="submit"
                                    class="btn btn-primary border-0 py-3 px-5 rounded-pill text-white position-absolute"
                                    style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6 col-xl-3">
                        <div class="footer-item-1">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <p class="text-secondary line-h">Address: <span class="text-white">123 Streat, New
                                    York</span>
                            </p>
                            <p class="text-secondary line-h">Email: <span class="text-white">Example@gmail.com</span>
                            </p>
                            <p class="text-secondary line-h">Phone: <span class="text-white">+0123 4567 8910</span>
                            </p>
                            <div class="d-flex line-h">
                                <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-twitter text-dark"></i></a>
                                <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-facebook-f text-dark"></i></a>
                                <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-youtube text-dark"></i></a>
                                <a class="btn btn-light btn-md-square rounded-circle" href=""><i
                                        class="fab fa-linkedin-in text-dark"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="footer-item-2">
                            <div class="d-flex flex-column mb-4">
                                <h4 class="mb-4 text-white">Recent Posts</h4>
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle  border-primary overflow-hidden">
                                            <img src="img/footer-1.jpg"
                                                class="img-zoomin img-fluid rounded-circle w-100" alt="">
                                        </div>
                                        <div class="d-flex flex-column ps-4">
                                            <p class="text-uppercase text-white mb-3">Life Style</p>
                                            <a href="#" class="h6 text-white">
                                                Get the best speak market, news.
                                            </a>
                                            <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                Dec
                                                9, 2024</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle border border-primary overflow-hidden">
                                            <img src="img/footer-2.jpg" class="img-zoominimg-fluid rounded-circle w-100"
                                                alt="">
                                        </div>
                                        <div class="d-flex flex-column ps-4">
                                            <p class="text-uppercase text-white mb-3">Sports</p>
                                            <a href="#" class="h6 text-white">
                                                Get the best speak market, news.
                                            </a>
                                            <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                Dec
                                                9, 2024</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="d-flex flex-column text-start footer-item-3">
                            <h4 class="mb-4 text-white">Categories</h4>
                            <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                                Sports</a>
                            <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                                Magazine</a>
                            <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                                Lifestyle</a>
                            <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                                Politician</a>
                            <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                                Technology</a>
                            <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                                Intertainment</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="footer-item-4">
                            <h4 class="mb-4 text-white">Our Gallary</h4>
                            <div class="row g-2">
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset('BlogTem/img/footer-1.jpg') }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset('BlogTem/img/footer-1.jpg') }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset('BlogTem/img/footer-1.jpg') }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset('BlogTem/img/footer-1.jpg') }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset('BlogTem/img/footer-1.jpg') }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset('BlogTem/img/footer-1.jpg') }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                                Site
                                Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-2 border-white rounded-circle back-to-top"><i
                class="fa fa-arrow-up"></i></a>


        <!-- JavaScript Libraries -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script src="{{ asset('BlogTem/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('BlogTem/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('BlogTem/lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('BlogTem/js/main.js') }}"></script>

        {{-- Current Date --}}
        <script>
            const options = {
            weekday: 'long',
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        };
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', options);
        </script>

        {{-- for noti --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            const bell = document.getElementById("notiBell");
            const badge = document.getElementById("notiBadge");
            const markAllUnread = document.getElementById("markAllUnread");

            // On bell click → mark all as read
            bell?.addEventListener("click", function() {
                badge?.remove(); // hide badge
                fetch("{{ route('notifications.markAllRead') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                });
            });

            // Mark all as unread
            markAllUnread?.addEventListener("click", function() {
                fetch("{{ route('notifications.markAllUnread') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                }).then(() => location.reload());
            });
        });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('showAllNoti');
            if (btn) {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.more-noti').forEach(item => {
                        item.classList.remove('d-none');
                    });
                    btn.remove(); // optional: remove the button after showing all
                });
            }
        });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('showAllNoti');
        if (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault(); // prevent any default behavior
                e.stopPropagation(); // prevent click from bubbling to dropdown toggle
                document.querySelectorAll('.more-noti').forEach(item => {
                    item.classList.remove('d-none');
                });
                btn.remove(); // remove the button
            });
        }
    });
        </script>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-..." crossorigin="anonymous"></script>
</body>


</html>