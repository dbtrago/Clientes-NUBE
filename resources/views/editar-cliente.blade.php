<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
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
        <h1 class="nota">Editar Cliente</h1>
        <p class="text-muted mb-2">Modifique los datos necesarios</p>
      </div>

      <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="datos" for="nombre">Nombre:</label>
          <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
        </div>

        <div class="mb-3">
          <label class="datos" for="correo">Correo:</label>
          <input type="email" class="form-control" name="correo" id="correo" value="{{ old('correo', $cliente->correo) }}">
        </div>

        <div class="mb-3">
          <label class="datos" for="telefono">Teléfono:</label>
          <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" maxlength="20">
        </div>

        <div class="mb-3">
          <label class="datos" for="direccion">Dirección:</label>
          <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}">
        </div>

        <div class="mb-3">
          <label class="datos" for="fecha_registro">Fecha de Registro:</label>
          <input type="date" class="form-control" name="fecha_registro" id="fecha_registro" value="{{ old('fecha_registro', $cliente->fecha_registro) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
      </form>
    </div>
  </div>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
