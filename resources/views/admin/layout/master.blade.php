<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    {{-- bootstrap cdn link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

<<<<<<< HEAD
    <style>
        @media screen and (max-width:500px){
            .category{
                display: none;
            }

            .phone-category{
                display: block !important; 
            }
        }
    </style>
=======
>>>>>>> 3aa2a25

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{asset('logo.svg')}}" alt="" class="w-50">
                </div>
                <div class="sidebar-brand-text mx-3">L.U.C.A Sale</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
<<<<<<< HEAD
                <a class="nav-link" href="{{route('category')}}"><i class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-layer-group"></i><span>Product Details </span></a>
=======
                <a class="nav-link" href="{{route('category')}}"><i class="fa-solid fa-circle-plus"></i></i><span>Add Category </span></a>
>>>>>>> 3aa2a25
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('categoryTable')}}"><i class="fa-solid fa-table"></i><span>Category Table</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('createproduct')}}"><i class="fa-solid fa-plus"></i></i><span>Add Product </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('productlist')}}"><i class="fa-solid fa-layer-group"></i><span>Product Details </span></a>
            </li>

            @if (Auth::user()->role == 'superadmin')
            <li class="nav-item">
                <a class="nav-link" href="{{route('payment')}}"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method </span></a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{route('orderlist')}}"><i class="fa-solid fa-cart-shopping"></i><span>Order Pending Board
                @if (Session::get('pendingData') > 0)
                <span class="badge text-bg-danger">{{Session::get('pendingData')}}</span>
                @endif
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('saleinformation')}}"><i class="fa-solid fa-list"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('feedback')}}"><i class="fas fa-fw fa-table"></i><span>Customer Feedback </span></a>
            </li>

            <li class="nav-item mt-2">
                <form action="{{route('logout')}}" method="POST" class="d-flex justify-content-center">
                    @csrf
                    <button type="submit" class="btn btn-dark rounded ">
                        <i class="fa-solid fa-right-from-bracket"></i><span>Logout </span>
                    </button>

                </form>

            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{Auth::user()->name ?? Auth::user()->nickname}}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{Auth::user()->profile ? asset('admin/img/'. Auth::user()->profile) : asset('admin/img/undraw_profile_2.svg')}}   ">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                @if (Auth::user()->role == 'superadmin')
                                <a class="dropdown-item" href="{{route('createadmin')}}">
                                    <i class="fa-solid fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Create Admin
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{route('adminlist')}}">
                                    <i class="fa-solid fa-user-tie fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin List
                                </a>
                                <a class="dropdown-item" href="{{route('userlist')}}">
                                    <i class="fa-solid fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User List
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('logout')}}" method="POST" class="d-flex justify-content-center">
                        @csrf
                        <button type="submit" class="btn btn-secondary rounded ">
                            <span>Logout </span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{ asset('admin/vendor/jquery/jquery.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function loadFile(event){
        let reader = new FileReader();

        reader.onload = function(){
            let output = document.getElementById('output');
            output.src=reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    @yield('jquery')
</body>



</html>
