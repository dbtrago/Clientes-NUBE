<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        h1.blue {
            margin-top: 50px;
            color: #2358b9;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .buscar input {
            width: 100%;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            transition: border-color 0.2s ease-in-out;
        }

        .buscar input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            width: 100%;
            background-color: #0984e3;
            border: none;
            font-weight: 600;
            border-radius: 0.4rem;
        }

        .btn-primary:hover {
            background-color: #74b9ff;
        }

        .btn-warning {
            font-weight: 600;
            border-radius: 0.4rem;
        }

        .btn-danger {
            font-weight: 600;
            border-radius: 0.4rem;
        }

        .table-container {
            margin-top: 2rem;
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .totalClientes {
            margin-top: 1rem;
            font-weight: 500;
            color: #2d3436;
            font-size: 1rem;
        }

        ul {
            padding-left: 1.2rem;
        }

        ul li {
            font-size: 0.95rem;
        }

        .alert-success {
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .pagination .page-link {
            border-radius: 0.4rem !important;
            color: #0984e3;
        }

        .pagination .active .page-link {
            background-color: #0984e3;
            border-color: #0984e3;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #dfe6e9;
        }

        footer {
            padding: 1rem 0;
            margin-top: 4rem;
            text-align: center;
            font-size: 0.95rem;
        }
    </style>

</head>

<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="blue">Sistema de gestión de clientes</h1>
            </div>
            <div class="col-md-9">
                <form method="GET" action="{{ route('clientes.index') }}">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar cliente..."
                        value="{{ request('buscar') }}">
                </form>
            </div>
            <div class="col-md-3">
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h6 class="totalClientes">Se han encontrado {{ $clientes->total() }} clientes.</h6>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>CC</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th class="d-none d-md-table-cell">Correo</th>
                            <th class="d-none d-md-table-cell">Compra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td class="d-none d-md-table-cell">{{ $cliente->correo }}</td>
                                <td class="d-none d-md-table-cell">
                                    @if($cliente->productos->isNotEmpty())
                                        <ul class="mb-0">
                                            @foreach($cliente->productos as $producto)
                                                <li>{{ $producto->nombre }} <small
                                                        class="text-muted">({{ $producto->pivot->fecha_adquisicion }})</small></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">Sin compras</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('clientes.destroy', $cliente) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">❌</button>
                                    </form>
                                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">✏️</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron clientes.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $clientes->withQueryString()->links() }}
        </div>
    </div>

    <footer>
        <strong>Daniel Buitrago</strong> &bull; <strong>Valeria Manjarrez</strong> &bull; <strong>Alejandro Alzate</strong>
    </footer>

    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>