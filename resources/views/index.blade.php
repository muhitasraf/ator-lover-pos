<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#563d7c">

    <title>Mirpur Pharmacy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ url('/') }}">Mirpur Farmacy</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('logout') }}">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @include('dashboard.sidebar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3 class="h3">{{$title}}</h3>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span> This week
                        </button>
                    </div>
                </div>
                @yield('content')
            </main>
        </div>
    </div>


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo asset('assets/js/select2.min.js')?>"></script>

    <script>
        let table = new DataTable('#myTable');

        $(document).ready(function() {
            initMenu();

            var currentRow = $("table.row_add tbody.append_row tr:last").html();
            $(".add_row_btn").click(function() {
                for (var k = 0; k < 3; k++) {
                    $("table.row_add").append('tbody.append_row <tr>' + currentRow + '</tr>');
                }
                $(".select2").select2();
            });

            //----------------Delete Row From Table-----------------

            // $('table.row_add').on('click', '.remove_row', function () {

            // });

            //----------------Initialize Select2-----------------
            $(".select2").select2({

            });
        });

        function initMenu() {
            $('#menu ul').hide();
            $('#menu li a').click(function() {
                $('#menu ul').hide('normal');
                // check if the next element is hidden
                if($(this).next().is(":hidden")) {
                    $(this).next().slideToggle('normal');
                }
            });
        }
        function remove_row($_this){
            $_this.closest('tr').remove();
        }
    </script>
     @yield('scripts')
</body>

</html>
