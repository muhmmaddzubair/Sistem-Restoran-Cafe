<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buku Menu Cafe')</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 24px 50px; color: #111; }
        h1 { margin: 0 0 4px; font-size: 34px; }
        h2 { margin: 40px 0 16px; font-size: 30px; }
        .subtitle { margin: 0 0 24px; font-size: 18px; }

        .alert { border: 1px solid #111; padding: 16px 20px; margin-bottom: 24px; font-weight: bold; }
        .alert-error { border-color: #b00020; color: #b00020; font-weight: normal; }
        .alert-error ul { margin: 0; padding-left: 20px; }

        table { width: 100%; border-collapse: collapse; border: 1px solid #ddd; }
        thead th { background: #000; color: #fff; text-align: left; padding: 18px 16px; }
        tbody td { padding: 18px 16px; border: 1px solid #ddd; vertical-align: middle; }
        td.center { text-align: center; }

        .btn { display: inline-block; background: #000; color: #fff; border: 0; padding: 9px 16px;
               cursor: pointer; text-decoration: none; font-size: 14px; }
        .btn:hover { background: #333; }
        .btn-light { background: #e5e5e5; color: #111; }
        .btn-light:hover { background: #d0d0d0; }
        .btn-danger { background: #b00020; }
        .btn-danger:hover { background: #8a0019; }

        input[type=text], input[type=number], input[type=file], select, textarea {
            width: 100%; padding: 9px 10px; border: 1px solid #ccc; font-size: 14px; font-family: inherit;
        }
        .form-box { max-width: 700px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 6px; }
        .actions { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
        .actions form { margin: 0; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .thumb { width: 80px; height: 60px; object-fit: cover; }
        .detail img { max-width: 360px; display: block; margin-bottom: 16px; }
        .detail p { margin: 8px 0; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>