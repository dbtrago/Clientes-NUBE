<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where('nombre', 'like', "%$buscar%")
                  ->orWhere('correo', 'like', "%$buscar%")
                  ->orWhere('telefono', 'like', "%$buscar%");
        }

        $clientes = $query->orderBy('fecha_registro', 'desc')->paginate(10);
        return view('home-cliente', compact('clientes'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('nuevo-cliente', compact('productos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'correo' => 'nullable|email|unique:clientes',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'fecha_registro' => 'required|date',
            'producto_id' => 'required|exists:productos,id',
        ]);

        $cliente = Cliente::create($request->only(['nombre', 'correo', 'telefono', 'direccion', 'fecha_registro']));

        // Asociar el producto seleccionado al cliente
        $cliente->productos()->attach($request->producto_id, [
            'fecha_adquisicion' => now()->toDateString(),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }


    public function edit(Cliente $cliente)
    {
        return view('editar-cliente', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'nullable|email|unique:clientes,correo,' . $cliente->id,
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'fecha_registro' => 'required|date',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}
