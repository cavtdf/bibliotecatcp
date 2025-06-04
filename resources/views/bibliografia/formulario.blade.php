<fieldset>
    <p>Los campos marcados con (*) son obligatorios.</p>
    <div class="row">
        <section class="col col-6">
               <label class="label">Categoría *</label>
               <select class="form-control" name="categoria" id="categoria">
                    <option value="">Seleccionar Categoría</option>
                        @foreach($categorias as $categoria)
                             <option value="{{$categoria->id_categoria}}" {{(old('categoria')==$categoria->id_categoria)? 'selected':''}}>{{$categoria->categoria}}</option>
                        @endforeach
                </select>
         </section>
        <section class="col col-6">
            <label class="label">Tipo *</label>
            <select class="form-control" name="tipo" id="tipo">
             <option value="">Seleccionar Tipo</option>
                @foreach($tipos as $tipo)
                    <option value="{{$tipo->id_tipo}}" {{(old('tipo')==$tipo->id_tipo)? 'selected':''}}>{{$tipo->tipo}}</option>
                @endforeach
            </select>

        </section>
    </div>
    <div class="row">
        <section class="col col-10">
            <label class="input">Titulo * 
                <input type="text" name="titulo" value="{{old('titulo', $data->titulo ?? '')}}" placeholder="Titulo">
            </label>
        </section>
    </div>

    <div class="row">
      <section class="col col-6">
            <label class="label">Autor *</label>
            <select class="form-control" name="autor" id="autor">
            <option value="">Seleccionar Autor</option>
                @foreach($autores as $autor)
                    <option value="{{$autor->id_autor}}" {{(old('autor')==$autor->id_autor)? 'selected':''}}>{{$autor->autor}}</option>
                @endforeach
            </select>
        </section>

        <section class="col col-6">
            <label class="label">Editorial *</label>
            <select class="form-control" name="editorial" id="editorial">
                <option value="">Seleccionar Editorial</option>
                    @foreach($editoriales as $editorial)
                        <option value="{{$editorial->id_editorial}}" {{(old('editorial')==$editorial->id_editorial)? 'selected' : ''}}>{{$editorial->editorial}}</option>
                    @endforeach
            </select>
        </section>
    </div>
    <div class="row">
            <section class="col col-6">
            <label class="input">ISBN
                <input type="text" name="isbn" value="{{old('isbn', $data->isbn ?? '')}}" placeholder="ISBN">
            </label>
            </section>
     </div>
</fieldset>
<fieldset>
    <div class="row">
        <section class="col col-6">
            <label class="label">Ubicación *</label>
            <select class="form-control" name="ubicacion" id="ubicacion">
                <option value="">Seleccionar Ubicación</option>
                    @foreach($ubicaciones as $ubicacion)
                        <option value="{{$ubicacion->id_ubicacion}}" {{(old('ubicacion')==$ubicacion->id_ubicacion)? 'selected':''}}>{{$ubicacion->ubicacion}}</option>
                    @endforeach
            </select>
        </section>
        <section class="col col-6">
            <label class="label">Estado *</label>
            <select class="form-control" name="estado" id="estado">
                <option value="">Seleccionar Estado</option>
                    @foreach($estados as $estado)
                        <option value="{{$estado->id_estado}}" {{(old('estado')==$estado->id_estado)? 'selected':''}}>{{$estado->estado}}</option>
                    @endforeach
            </select>

        </section>
    </div>
</fieldset>
{{-- <fieldset>
     <div class="row">
        <section class="col col-6">
            <label for="foto" class="col-lg-6 control-label">Caratula y/o Indice de la Bibliografía</label>
            <div class="col-lg-8">
                <input type="file" name="foto_up" id="foto"/>
            </div>
        </section>
     </div>
</fieldset> --}}

<fieldset>
  <section>
        <label class="textarea"> <i class="icon-append fa fa-comment"></i>Descripcion
            <textarea rows="5" name="descripcion" placeholder="Descripcion...">{{old('descripcion', $data->descripcion ?? '')}}</textarea>
        </label>
    </section>
    <section>
        <label class="textarea"> <i class="icon-append fa fa-pencil"></i>Links
            <textarea rows="5" name="notas" placeholder="Links...">{{old('notas', $data->notas ?? '')}}</textarea>
        </label>
    </section>
</fieldset>
