@extends('home')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Registro</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('company.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> volver</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Verifique los errores marcados.<br>
    </div>
    @elseif ($messageWarning = Session::get('ErrorStatus'))
        <div class="alert alert-danger">
            
            <strong>Oops!</strong> Verifique los errores marcados.<br>
        </div>
    @endif


    @if ($message = Session::get('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @else
    <div>{{ $message }}</div>
    @endif

    <div class="card card-cyan card-outline card-body">
    <div class="row">
        <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="container">
                <div class="row">
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-4">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nombre: </span>
                            </div>
                             <input type="text" class="form-control"  placeholder="Nombre" name="nombre" id="nombre"  value="{{ $company->nombre }}">
                            @if ($errors->has('nombre'))
                            <small id="linkError" class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="container"><br /></div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-4">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Correo: </span>
                            </div>
                             <input type="text" class="form-control"  placeholder="correo@prueba.com" name="correo" id="correo"  value="{{ $company->correo }}">
                            @if ($errors->has('correo'))
                            <small id="linkError" class="form-text text-danger">{{ $errors->first('correo') }}</small>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container"><br /></div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-4 text-center">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Logo: </span>
                            </div>
                             <input type="file"   name="logo" class="form-control"  >
                        </div>
                        @if ($errors->has('logo'))
                                <small id="linkError" class="form-text text-danger">{{ $errors->first('logo') }}</small>
                        @endif
                        <a title="Logo" href="{{ asset(env('PATH_FILES')) }}/{{ $company->logo }}"   target="_blank">
                            @if(file_exists(env('PATH_FILES')."/".$company->logo)) 
                            <img src="{{ asset(env('PATH_FILES')) }}/{{ $company->logo }}"   alt="logo" height="90"  width="90">
                            @endif
                        </a>
                    </div>
                     
                </div>
            </div>
            

            <div class="container"><br /></div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-4">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Página Web: </span>
                            </div>
                             <input type="text" class="form-control"  placeholder="prueba.com" name="pagina_web" id="pagina_web"  value="{{ $company->pagina_web }}">
                            @if ($errors->has('pagina_web'))
                            <small id="linkError" class="form-text text-danger">{{ $errors->first('pagina_web') }}</small>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="container"><br /></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-4 text-center">
                        <button type="submit" class="btn btn-sm btn-outline-info">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
       
    </div>
</div>
</div>

@endsection