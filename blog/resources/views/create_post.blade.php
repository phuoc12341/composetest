<!DOCTYPE html>
<html lang="en">
<head>
    <script>window.locale = "{{ app()->getLocale() }}"</script>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/laroute.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-12">

                <div id="app">
                    <create-post-component></create-post-component>
                    
                </div>
                
            </div>
        </div>
    </div>
</body>
<script src="/js/app.js"></script>
</html>