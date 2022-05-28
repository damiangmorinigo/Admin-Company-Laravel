<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use DB;

class EmployeeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = DB::table('employee') 
        ->Join('company', 'employee.id_company', '=', 'company.id')
                        ->select(
                          'company.nombre AS company',
                          'employee.nombre AS nombre',
                          'employee.apellido AS apellido',
                          'employee.id AS id'
                      )
        ->paginate(10);
	
        return view('employee.index', [
            'empleados' => $empleados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companias = DB::table('company')->get();
        return view('employee.create', [
            'companias' => $companias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request, Employee $employee)
    {
        DB::beginTransaction();
        try 
        {
            $data=array();
            $data['nombre']            = $request->nombre;
            $data['apellido']              = $request->apellido;
            $data['id_company']  = $request->id_company;     
            DB::table('employee')->insert($data);
            DB::commit();
            return redirect()->route('employee.index')  ->with('success','El registro fue creado correctamente.');
        }catch (Throwable $e)
        {
            DB::rollback();
            return redirect()->route('employee.index')->with('error', 'Se ha producido un error en la transacción.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = DB::table('employee') ->where('id', $id)->first();
        $companias = DB::table('company')->get();
        return view('employee.edit')->with(['employee' => $employee, 'companias' => $companias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        DB::beginTransaction();
        try 
        {
            $data=array();
            $data['nombre']  = $request->nombre;
            $data['apellido']  = $request->apellido;
            $data['id_company']  = $request->id_company;     
            DB::table('employee')->where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('employee.index')  ->with('success','El registro fue modificado correctamente.');
        }catch (Throwable $e)
        {
            DB::rollback();
            return redirect()->route('employee.index')->with('error', 'Se ha producido un error en la transacción.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('employee')  ->where('id', $id) ->delete();

       return redirect()->route('employee.index') ->with('success','El registro se ha borrado con éxito');
    }
}
