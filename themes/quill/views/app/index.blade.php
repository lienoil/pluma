<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Single App</title>
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ theme('dist/css/app.css') }}?v={{ date('YHis') }}">
</head>
<body>

  @section('app')
    <div id="app"></div>
  @show

  <script src="{{ theme('dist/js/app.js') }}?v={{ date('YHis') }}"></script>
</body>
</html>
