<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Agenda Resmi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-custom { background-color: #003366; } /* Biru Instansi */
        .card-custom { border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-top: 4px solid #003366; }
        .btn-primary-custom { background-color: #003366; border-color: #003366; color: white; }
        .btn-primary-custom:hover { background-color: #002244; color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('form.index') }}">SISTEM AGENDA</a>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>