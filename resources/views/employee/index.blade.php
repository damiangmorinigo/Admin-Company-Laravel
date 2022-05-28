@extends('home')

@section('content')

<div class="container-fluid px-4">
  <h1 class="mt-4">Empleados</h1>
  
  <div class="row mt-3 mb-3">
    <div class="col-sm-4 text-right">
        <a class="btn btn-sm btn-outline-success" href="{{ route('employee.create') }}" title="Agregar registro"> 
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
          <th scope="col">Apellido</th>
          <th scope="col">Compañia</th>
          <th scope="col" class="text-center ml-2">Acciones</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($empleados as $index => $employee)
          <tr>
            <th scope="row">
              <span class="text-center ml-2">{{ $loop->index + 1 }}</span>
            </th>
           
            <td>

              <span >{{ $employee->nombre }}</span> 

            </td>
            
            <td class="ml-2 px-6 py-2">
              
              <span >{{ $employee->apellido }}</span>

            </td>

            <td class="ml-2 px-6 py-2">
              
              <span >{{ $employee->company }}</span>

            </td>


            
            <td>
              <span class="text-center ml-2">
                <form id="form_employee_{{ $employee->id }}" action="{{ route('employee.destroy', $employee->id) }}" method="POST">
    
                  <a class="btn btn-sm btn-outline-info" href="{{ route('employee.edit', $employee->id) }}"><i class="fas fa-edit"></i> Editar</a>
   
                  @csrf
                  @method('DELETE')
      
                  <button type="button" onclick="javascript:alertDelete('form_employee_{{ $employee->id }}')" class="btn btn-sm btn-outline-danger"><i class="fas fa-edit"></i> Borrar</button>
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
      @isset($empleados)
        {{ $empleados->links('vendor.pagination.bootstrap-4') }}
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