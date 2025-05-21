<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Clientes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .nota { color: #2c3e50; font-weight: bold; margin-top: 50px;}
    .datos { font-weight: 500; margin-bottom: 0.3rem; }
    .formulario { max-width: 600px; margin: auto; }
    .encabezado { margin-bottom: 2rem; }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="formulario">
      <div class="encabezado text-center">
        <h1 class="nota">Registro de Clientes</h1>
        <p class="text-muted mb-2">Recuerde ingresar todos los campos</p>
      </div>

      <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="datos" for="nombre">Nombre:</label>
          <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>

        <div class="mb-3">
          <label class="datos" for="correo">Correo:</label>
          <input type="email" class="form-control" name="correo" id="correo">
        </div>

        <div class="mb-3">
          <label class="datos" for="telefono">Teléfono:</label>
          <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20">
        </div>

        <div class="mb-3">
          <label class="datos" for="direccion">Dirección:</label>
          <input type="text" class="form-control" name="direccion" id="direccion">
        </div>

        <div class="mb-3">
          <label class="datos" for="fecha_registro">Fecha de Registro:</label>
          <input type="date" class="form-control" name="fecha_registro" id="fecha_registro" required>
        </div>

        <div class="mb-3">
          <label class="datos" for="producto_id">Producto adquirido:</label>
          <select class="form-select" name="producto_id" id="producto_id" required>
            <option value="" disabled selected>Seleccione un producto</option>
            @foreach ($productos as $producto)
              <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Datos</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
