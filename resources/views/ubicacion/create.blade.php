@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Nueva Ubicación</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ubicacion.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="ubicacion" class="col-md-4 col-form-label text-md-right">Nombre de la Ubicación</label>
                            <div class="col-md-6">
                                <input id="ubicacion" type="text" class="form-control @error('ubicacion') is-invalid @enderror" name="ubicacion" value="{{ old('ubicacion') }}" required autocomplete="ubicacion" autofocus>

                                @error('ubicacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_categoria" class="col-md-4 col-form-label text-md-right">Categoría</label>
                            <div class="col-md-6">
                                <select id="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror" name="id_categoria" required>
                                    <option value="">Seleccione una Categoría</option>
                                    @foreach($categoria as $cat)
                                        <option value="{{ $cat->id_categoria }}" {{ old('id_categoria') == $cat->id_categoria ? 'selected' : '' }}>{{ $cat->categoria }}</option>
                                    @endforeach
                                </select>

                                @error('id_categoria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Ubicación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 