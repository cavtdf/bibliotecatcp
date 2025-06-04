@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Rol</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('rol.update', $rol->id) }}">
        @csrf
        @method('PUT') {{-- Usamos el método PUT para las actualizaciones --}}

        <div class="form-group">
            <label for="name">Nombre del Rol:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $rol->name ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
        <a href="{{ route('rol.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>
</div>
@endsection 