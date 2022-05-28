<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use DB;

class CompanyController extends Controller
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
        $companias = DB::table('company') ->paginate(10);
	
        return view('company.index', [
            'companias' => $companias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CompanyRequest $request, Company $company)
    {
        DB::beginTransaction();
        try 
        {
            $data=array();
            if(empty($request->file('logo')))
            {
                $request->validate(['file' => 'required'],['file.required' => '(*) Debe cargar una imagen. ']);
            } 
            else
            {
                $image = $request->file('logo');
                $profileImage = md5(Carbon::now()->timestamp). "." . $image->getClientOriginalExtension();
                $destinationPath = env("PATH_FILES");
                $image->move($destinationPath, $profileImage);
                $data['logo'] = $profileImage;
            }

            $data['nombre']            = $request->nombre;
            $data['correo']              = $request->correo;
            $data['pagina_web']  = $request->pagina_web;     
            DB::table('company')->insert($data);
            DB::commit();

            return redirect()->route('company.index')  ->with('success','El registro fue creado correctamente.');

        }catch (Throwable $e)
        {
            DB::rollback();
            return redirect()->route('company.index')->with('error', 'Se ha producido un error en la transacción.');
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
        $company = DB::table('company') ->where('id', $id)->first();
        return view('company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'nombre'     => 'required',
            'logo'     => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
          ],
          [
            'nombre.required'     => '(*) El nombre es requerido. Debe ingresarlo. ',
            'logo.mimes'        => '(*) Error en el formato, los permitidos son jpeg,png,jpg,gif,svg. ',
            'logo.image'        => '(*) El archivo ingresado debe ser una imagen. ',
            'logo.dimensions'          => '(*) La imagen debe tyener una dimención de 100x100. ',
          ]);

        DB::beginTransaction();
        try 
        {
            $image = $request->file('logo');
            if($image){
              $destinationPath = env("PATH_FILES");
              $profileImage = md5(Carbon::now()->timestamp). "." . $image->getClientOriginalExtension();
              $success = $image->move($destinationPath, $profileImage);
              if($success){
                $data['logo'] = "$profileImage";
              }
            }

            $data['nombre']            = $request->nombre;
            $data['correo']              = $request->correo;
            $data['pagina_web']  = $request->pagina_web;     
            DB::table('company')->where('id', $id)->update($data);
            DB::commit();

            return redirect()->route('company.index')->with('success','El registro fue modificado correctamente.');

        }catch (Throwable $e)
        {
            DB::rollback();
            return redirect()->route('company.index')->with('error', 'Se ha producido un error en la transacción.');
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
      $company = DB::table('company')->where('id', $id)->first();  
      //ELIMINO LA IMAGEN
      $img = $company-> logo;
      $destinationPath = env("PATH_FILES")."/".$img;
      if (@getimagesize($destinationPath)) {
        unlink($destinationPath);
      }

       DB::table('company')  ->where('id', $id) ->delete();

       return redirect()->route('company.index') ->with('success','El registro se ha borrado con éxito');
    }
}
