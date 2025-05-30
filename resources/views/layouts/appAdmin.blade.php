<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ZooAdmin') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


</head>
<body class="bg-gray-100">
    <div class="container mx-auto">
        <!-- Navbar ou Sidebar ici -->
        @include('layouts.navbar')

        <!-- Contenu principal -->
        <div class="content py-4">
            @yield('content')  <!-- Contenu spécifique à chaque page -->
        </div>
    </div>
    
</body>
</html>


