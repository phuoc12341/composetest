<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <example-component></example-component>
        </div>

        <div id="test">
            <my-component></my-component>
        </div>

        <div id="test2">
            <test2-component></test2-component>
        </div>

        <div id="parent-todo-item-component">
            <parent-todo-item-component></parent-todo-item-component>
        </div>

    </body>
    <script src="/js/app.js"></script>
</html>