<!DOCTYPE html>
<html>
<title>Timekeeping</title>
    <head>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.css') }}">
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('mdlfile/material.min.css') }}">
        <script src="{{ asset('mdlfile/material.min.js') }}"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css" type="text/css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('Timekeeping.css') }}">
        <link rel="stylesheet" href="{{ asset('newcss.css') }}">
        <!-- for JQuery-ui-->
        <link rel="stylesheet" href="jquery/jquery-ui.css">
        <script src="jquery/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script>
            $(function() {
              $( "#datepicker" ).datepicker({
                  changeYear: true,
                  yearRange: '2010:2016',
                  changeMonth: true,
                  dateFormat: 'yy-mm-dd'
              });
            });

            $(function() {
              $( "#datepicker1" ).datepicker({
                  changeYear: true,
                  yearRange: '2010:2016',
                  changeMonth: true,
                  dateFormat: 'yy-mm-dd'
              });
            });

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
    </head>
    <body class = "md1">    
        @yield('body')               
    </body>
</html>
