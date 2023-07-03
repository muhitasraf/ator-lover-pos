<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#563d7c">

    <title>Ator Lover POS</title>
    {{-- <link rel="stylesheet" href="{{asset('assets/css/font-awesome/all.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
</head>

<body>
    @include('dashboard.navbar')
    <div class="container-fluid">
        <div class="row">
            @include('dashboard.sidebar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mb-3">
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


    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>


        $(document).ready(function() {

            $('#data_table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );

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
