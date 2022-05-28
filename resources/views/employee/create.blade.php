@extends('home')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Agregar Registro</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('employee.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> volver</a></li>
            <li class="breadcrumb-item active" aria-current="page">Agregar</li>
        </ol>
    </nav>

    @if ($errors->any())
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
        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-4">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Apellido: </span>
                            </div>
                             <input type="text" class="form-control"  placeholder="apellido" name="apellido" id="apellido"  value="{{old('apellido')}}">
                            @if ($errors->has('apellido'))
                            <small id="linkError" class="form-text text-danger">{{ $errors->first('apellido') }}</small>
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
                                <span class="input-group-text">Nombre: </span>
                            </div>
                             <input type="text" class="form-control"  placeholder="Nombre" name="nombre" id="nombre"  value="{{old('nombre')}}">
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
                                <span class="input-group-text">Compañia: </span>
                            </div>
                            <select class="form-control" id="id_company" name="id_company">
                                <option value="">Seleccione...</option>
                                @foreach ($companias as $index => $company)
                                    @if( old('id_company') == $company->id)
                                    <option selected value="{{$company->id}}">{!!$company->descripcion!!}</option>
                                    @else
                                    <option value="{{$company->id}}">{!!$company->nombre!!}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->has('id_company'))
                            <small id="linkError" class="form-text text-danger">{{ $errors->first('id_company') }}</small>
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
                        <button type="submit" class="btn btn-sm btn-outline-info">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
       
    </div>

    </div>
</div>

@endsection