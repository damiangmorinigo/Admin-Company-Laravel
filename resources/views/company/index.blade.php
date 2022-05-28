@extends('home')

@section('content')

<div class="container-fluid px-4">
  <h1 class="mt-4">Compañias</h1>
  
  <div class="row mt-3 mb-3">
    <div class="col-sm-4 text-right">
        <a class="btn btn-sm btn-outline-success" href="{{ route('company.create') }}" title="Agregar registro"> 
            <i class="fas fa-plus-circle"></i>
            Agregar
        </a>
    </div>
  </div>

  @if ($message = Session::get('success'))

        <script> 

            Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Acción realizada correctamente",
                      showConfirmButton: false,
                      timer: 2000,
                    });
        </script>

  @endif
  <div class="row">
    <table class="table">
      <thead>
        <tr class="btn-primary">
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Logo</th>
          <th scope="col">Página Web</th>
          <th scope="col" class="text-center ml-2">Acciones</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($companias as $index => $company)
          <tr>
            <th scope="row">
              <span class="text-center ml-2">{{ $loop->index + 1 }}</span>
            </th>
           
            <td>

              <span >{{ $company->nombre }}</span> 

            </td>
            
            <td class="ml-2 px-6 py-2">
              
              <span >{{ $company->correo }}</span>

            </td>

            <td class="ml-2 px-6 py-2">

               

              @isset($company->logo)
               <a title="Enviar Acceso" href="{{ asset(env('PATH_FILES')) }}/{{ $company->logo }}"   target="_blank"> 
                  @if(file_exists(env('PATH_FILES')."/".$company->logo)) 
                  <img src="{{ asset(env('PATH_FILES')) }}/{{ $company->logo }}"   alt="logo" height="90"  width="90">
                  @endif 
                </a> 
              @endisset

            </td>

            <td class="ml-2">
              
              @isset($company->pagina_web)
              <a title="{{ $company->pagina_web }}" href="{{ $company->pagina_web }}"   target="_blank">{{ $company->pagina_web }}</a>
              @endisset
            </td>

            
            <td>
              <span class="text-center ml-2">
                <form id="form_company_{{ $company->id }}" action="{{ route('company.destroy', $company->id) }}" method="POST">
    
                  <a class="btn btn-sm btn-outline-info" href="{{ route('company.edit', $company->id) }}"><i class="fas fa-edit"></i> Editar</a>
   
                  @csrf
                  @method('DELETE')
      
                  <button type="button" onclick="javascript:alertDelete('form_company_{{ $company->id }}')" class="btn btn-sm btn-outline-danger"><i class="fas fa-edit"></i> Borrar</button>
                </form>
              </span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>
  

  <div class="row">
    <div class="col-sm-4 text-center"> </div>
    <div class="col-sm-4 text-center">
      @isset($companias)
        {{ $companias->links('vendor.pagination.bootstrap-4') }}
      @endisset
    </div>
    <div class="col-sm-4 text-center"> </div>
  </div>

</div>

@endsection

<script>
    function alertDelete(form) {
        Swal.fire({
            title: "¿Estas seguro?",
            text: "Este cambio sera permanente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, borrar!",
            }).then((result) => {
            if (result.value) {
                //si presiona la tecla ok //ajax
                $("#"+ form ).submit();
            } //if
        }); //.them
    }
    
</script>