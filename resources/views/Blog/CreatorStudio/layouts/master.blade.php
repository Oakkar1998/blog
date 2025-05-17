<!doctype html>
<html lang="en">

<head>
    <title>Creator Studio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('sidebarTemp/css/style.css') }}">
    
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> --}}
</head>

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

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">

            <div class="p-4 pt-5">
                @if(Auth::user()->image)
                <a href="#" class="img logo rounded-circle mb-3 border border-warning"
                    style="background-image: url('{{ asset('storage/' . Auth::user()->image) }}');">
                </a>
                @else
                <a href="#" class="img logo rounded-circle mb-3"
                    style="background-image: url('{{ asset('Photos/noprofile.jpg') }}');">
                </a>
                @endif

                <!-- Trigger Modal -->
                <div class="d-flex justify-content-center my-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        Upload Photo
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('creator.uploadCreatorImage') }}" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            @csrf


                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload Profile Photo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body text-center">
                                
                                @if(Auth::user()->image)
                                <div class="d-flex justify-content-center my-3">
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" id="preview" alt="" class="img logo rounded-circle" alt="" width="300" height="300">
                                    
                                </div>  
                                @else
                                <div class="d-flex justify-content-center my-3">
                                    <img src="{{ asset('Photos/noprofile.jpg')}}" id="preview" alt="" class="img logo rounded-circle" alt="" width="300" height="300">
                                    
                                </div>
                                @endif
                                <label class="btn btn-sm btn-warning w-50">
                                    Choose Image
                                    <input type="file" name="image" hidden
                                    onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                    
                                </label>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>



                <h5 class="text-white text-center">Creator Studio</h5>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            Blog Management</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="{{ route('creator.articlePage') }}">Articles</a>
                            </li>
                            <li>
                                <a href="{{ route('creator.categoryPage') }}">Categories</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            User Management</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Users</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Portfolio</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>

                <div class="footer">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
            <div class="d-flex justify-content-end">
                <a href="{{ route('home') }}" class="btn btn-sm btn-dark">Back to Blog</a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>



                </div>
            </nav>

            @yield('content')


        </div>
    </div>

    <script src="{{ asset('sidebarTemp/js/jquery.min.js') }}"></script>

    <script src="{{ asset('sidebarTemp/js/popper.js') }}"></script>


    <script src="{{ asset('sidebarTemp/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('sidebarTemp/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>