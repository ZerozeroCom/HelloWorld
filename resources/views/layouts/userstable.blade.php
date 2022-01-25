<html>
    <head>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
        <script src="{{ mix('js/app.js') }}"></script>
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/jquery-3.6.0.min.js" ></script>
        <script src="/js/bootstrap.min.js" ></script>
        <script src="/js/jquery.dataTables.js" ></script>
    </head>
    <body>


        {{$dataTable->table()}}


    </body>
    {{$dataTable->scripts()}}


</html>
