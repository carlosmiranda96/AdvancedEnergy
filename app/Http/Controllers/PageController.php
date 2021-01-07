<?php

namespace App\Http\Controllers;

use App\Models\autorizacionusuarios;
use App\Models\empleados;
use App\Models\marcacionesempleados;
use App\Models\User;
use App\Models\equipostrabajo;
use App\Models\equiposhistorial;
use App\Models\empleadoUser;
use App\Models\ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{
	public function __construct()
	{
		date_default_timezone_set('America/El_Salvador');
	}
	//API ASISTENCIA
	public function asistencia(Request $request)
	{
		$id = $request->a;
		$toquen = $request->b;
		if(isset($id)){
			$empleado = empleados::where('id',$id)->where('toquen',$toquen)->first();
			if(isset($empleado))
			{
				//session()->put('codigoCarnet',$empleado->codigo);
				return view('qr.carnet',compact('empleado'));
			}else{
				abort(404);
			}
		}else{
			abort(404);
		}
	}
	//API VEHICULO
	public function vehiculo(Request $request)
	{
			$latitud = $request->latitud;
			$longitud = $request->longitud;
			$idempleado = $request->idempleado;
			if(isset($latitud) && isset($longitud) && isset($idempleado)){
				$empleado = empleados::find($idempleado);
				if(isset($empleado)){
					return view('qr.vehiculo',compact('empleado','latitud','longitud'));
				}else{
					abort(404);
				}
			}else{
				abort(404);
			}
	}
	public function abrirescaner(Request $request)
	{
		$latitud = $request->latitud;
		$longitud = $request->longitud;
		$idempleado = $request->idempleado;
		if(isset($latitud) && isset($longitud) && isset($idempleado)){
			$empleado = empleados::find($idempleado);
			if(isset($empleado)){
				session()->put('codigoCarnet',$empleado->codigo);
				return view('qr.escaner',compact('empleado','latitud','longitud'));
			}else{
				abort(404);
			}
		}else{
			abort(404);
		}
	}
	//Ubicacion
	public function ubicacion(Request $request)
	{
		$id = $request->id;
		$ubicacion = ubicacion::find($id);
		if(isset($ubicacion)){
			session()->put('idubicacion',$id);
			return view('qr.ubicacion',compact('ubicacion'));
		}else{
			abort(404);
		}
	}
	public function login(Request $request)
	{
		if(session()->has('user_id'))
		{
			return redirect()->route('inicio');
		}else{
			//VERIFICAR LAS COOKIES DE SESION
			$email = '';
			$password = '';
			$email = $request->cookie('email');
			$password = $request->cookie('password');
			return view('login',compact('email','password'));
		}
	}
	public function registrarse(Request $request)
	{
		return view('registro');
	}
	public function iniciarsesion(Request $request)
	{
		$usuario = User::where('email',$request->email)->first();
		if(isset($usuario))
		{

			$usuarioFill = User::find($usuario->id);
			$decrypted = Crypt::decryptString($usuarioFill->password);
			if($decrypted==$request->password){
				session()->put('user_id', $usuario->id);
				session()->put('name', $usuario->name);
				session()->put('email',$usuario->email);
				session()->put('foto','storage/app/'.$usuario->foto);
				session()->put('idrol',$usuario->idrol);
				session()->put('menu_id',5);//Seleccionar menu inicio
				if($request->recordar)
				{
					//Crear cookie para recordar el email y contraseña
					$minutos = 2880;//48 Horas
					$cookie1 = cookie('email',$request->email,$minutos);
					$cookie2 = cookie('password',$request->password,$minutos);
					return redirect('inicio')->withCookie($cookie1)->withCookie($cookie2);
				}else{
					$cookie1 = Cookie::forget('email');
					$cookie2 = Cookie::forget('password');
					return redirect('inicio')->withCookie($cookie1)->withCookie($cookie2);
				}
				
			}else{
				return redirect()->route('login')->with('mensaje', 'La clave ingresada es incorrecta');
			}
		}else{
			return redirect()->route('login')->with('mensaje', 'Usuario ingresado es incorrecto ');		
		}		
	}
	public function sessionmenu(Request $request)
	{
		session()->put('menu_id',$request->id);
	}
	public function cerrar()
	{
		session()->flush();
		return redirect('/');
	}
    public function inicio()
    {
		$idusuario = session('user_id');
		return view('inicio');
	}
	public function recordar()
	{
		return view('recordar');
	}
	public function general(){
		return view('general.general');
	}
	public function lector(){
		return view('qr.lectorqr');
	}
	public function rrhh(){
		return view('rrhh.rrhh');
	}
	public function marcaciones(Request $request)
	{
		echo $request->id;
		/*
		$data['marcaciones'] = marcacionesempleados::all();
		return view('qr.marcacion',$data);*/
	}
	public function equipos()
	{
		return view('qr.equipos');
	}
	public function obtenerEmpleado(Request $request)
	{
		$idusuario = $request->idusuario;
		$empleado = empleadoUser::join('empleados','idempleado','empleados.id')->select('empleados.*')->where('idusuario',$idusuario)->first();
		if(isset($empleado)){
			$datos[0]['id'] = $empleado->id;
			$datos[0]['nombre'] = $empleado->nombreCompleto;
			$datos[1]['id'] = '0';
			$datos[1]['nombre'] = 'Seleccione';
		}else{
			$datos[0]['id'] = '0';
			$datos[0]['nombre'] = 'Seleccione';
		}
		echo json_encode($datos);
	}
	public function obtenerubicacion(Request $request)
	{
		$latitud = $request->latitud;
		$longitud = $request->longitud;
		$distancia = 0.5; // Sitios que se encuentren en un radio de 500METROS
		$perimetro = $this->getBoundaries($latitud, $longitud,$distancia);

		$ubicaciones = ubicacion::select('ubicacions.*',
		ubicacion::raw('6371*ACOS(COS(RADIANS('.$latitud.'))*COS(RADIANS(latitud))*COS(RADIANS(longitud)-RADIANS('.$longitud.'))+SIN(RADIANS('.$latitud.'))*SIN(RADIANS(latitud))) as diferencia'))
		->whereBetween('latitud',[$perimetro['min_lat'],$perimetro['max_lat']])
		->whereRaw('longitud*-1>='.$perimetro['max_lng']*-1)->whereRaw('longitud*-1<='.$perimetro['min_lng']*-1)
		->get();
		$datos = array();
		$contador = 0;
		foreach($ubicaciones as $item)
		{
			$contador++;
			$datos[$contador] = $item;
		}
		if(session()->has('idubicacion')){
			$ubicacion = ubicacion::find(session('idubicacion'));
			$contador++;
			$datos[$contador]['id'] = $ubicacion->id;
			$datos[$contador]['descripcion'] = $ubicacion->descripcion;
		}
		if($contador==0){
			$datos[0]['id'] = '0';
			$datos[0]['descripcion'] = 'Fuera de rango';
		}else{
			$contador++;
			$datos[$contador]['id'] = '0';
			$datos[$contador]['descripcion'] = 'Seleccione';
		}
		echo json_encode($datos);
	}
	private function getBoundaries($lat, $lng, $distance = 1, $earthRadius = 6371)
	{
		$return = array();
		// Los angulos para cada dirección
		$cardinalCoords = array('north' => '0',
								'south' => '180',
								'east' => '90',
								'west' => '270');
		$rLat = deg2rad($lat);
		$rLng = deg2rad($lng);
		$rAngDist = $distance/$earthRadius;
		foreach ($cardinalCoords as $name => $angle)
		{
			$rAngle = deg2rad($angle);
			$rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
			$rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));

			$return[$name] = array('lat' => (float) rad2deg($rLatB), 
									'lng' => (float) rad2deg($rLonB));
		}
		return array('min_lat'  => $return['south']['lat'],
					'max_lat' => $return['north']['lat'],
					'min_lng' => $return['west']['lng'],
					'max_lng' => $return['east']['lng']);
	}
	public function escaner(Request $request)
	{
		$contenido = $request->contenido;
		$idusuario = $request->idusuario;
		$idempleado = $request->idempleado;
		$latitud = $request->latitud;
		$longitud = $request->longitud;
		$idubicacion = $request->idubicacion;
		$split = explode(';',$contenido);
		if(isset($split['0']))
		{
			switch($split['0'])
			{
				case 'Vehiculo':
					$codigovehiculo = trim($split['1']);
					$vehiculo = equipostrabajo::where('codigo',$codigovehiculo)->first();
					if(isset($vehiculo))
					{
						$idequipotrabajo = $vehiculo->id;
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$instante = date('Y-m-d H:i:s');
						if(isset($idempleado) && $idempleado>0){
							//Para guardar verificar que el ultimo registro tenga mas de 15 minutos de ser asignado
							$ultimoregistro = equiposhistorial::where('idempleado',$idempleado)->where('idequipotrabajo',$idequipotrabajo)->get();
							$ultimoregistro = $ultimoregistro->last();
							$minutos = 0;
							$segundos = 0;
							$tiempo = '';
							if(isset($ultimoregistro)){
								$date1 = new \DateTime($ultimoregistro->instante);
								$date2 = new \DateTime($instante);
								$diff = $date1->diff($date2);
								$minutos = (($diff->days*24)*60)+($diff->i);
								$segundos = $diff->s;
								if($minutos>15){
									$segundos = 0;
								}
								if($minutos==0){
									$tiempo = $segundos.' segundos';
								}else if($minutos==1){
									$tiempo = "1 minuto con ".$segundos.' segundos';
								}else if($minutos>1){
									$tiempo = $minutos." minutos con ".$segundos.' segundos';
								}
							}
							if(isset($ultimoregistro) && $minutos<=15)
							{
								$data['id'] = 0;
								$data['mensaje'] = '<h3 class="text-primary text-center">Vehiculo fue asignado hace '.$tiempo.'</h3><br><h5 class="text-danger text-center">Espera 15 min para volver a escanear el mismo codigo</h5>';
								echo json_encode($data);
							}
							else
							{
								$historial = equiposhistorial::create([
									'instante' => $instante,
									'idequipotrabajo' => $idequipotrabajo,
									'idempleado' => $idempleado,
									'idusuario' => $idusuario,
									'latitud' => $latitud,
									'longitud' => $longitud
								]);
								$data['id'] = 0;
								if(session()->has('codigoCarnet')){
									//SI SE LLENO DESDE LA API
								$data['mensaje'] = '<h3 class="text-primary text-center">Vehiculo asignado</h3>
								<h6 class="text-danger text-center">Por favor llenar el siguiente formulario para finalizar el registro</h6>
								<a href="'.route('api.form.vehiculo',['id'=>$historial->id]).'"><button class="btn btn-primary col-12"><i class="fas fa-share-square"></i> Formulario</button></a>';
								}else{
								$data['mensaje'] = '<h3 class="text-primary text-center">Vehiculo asignado</h3>
									<h6 class="text-danger text-center">Por favor llenar el siguiente formulario para finalizar el registro</h6>
									<a href="'.route('equiposhistorial.edit',$historial->id).'"><button class="btn btn-primary col-12"><i class="fas fa-share-square"></i> Formulario</button></a>';
								}
								
								echo json_encode($data);
							}
						}else{
							$data['id'] = 0;
							$data['mensaje'] = '<h3 class="text-danger text-center">Empleado no válido, por favor seleccionar empleado o escanear QR de carnet</h3>';
							echo json_encode($data);
						}
					}else{
						$data['id'] = 0;
						$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><h3 class="text-danger text-center">Equipo no esta registrado</h3>';
						echo json_encode($data);
					}
				break;
				case 'Carnet':
					$hora = date('H:i:s');
					$instante = date('H:i:s');
					$fecha = date('Y-m-d');
					$tipo = "Entrada";
					if($hora>date('H:i:s',strtotime('12:00:00')))
					{
						$tipo = "Salida";
					}
					$codigoEmpleado = trim($split['1']);
					if(isset($codigoEmpleado))
					{
						if(isset($idubicacion) && $idubicacion=="76AE")
						{
							$empleadoCarnet = empleados::where('codigo',$codigoEmpleado)->first();
							if(isset($empleadoCarnet))
							{
								$empleado['id'] = $empleadoCarnet->id;
								$empleado['nombre'] = $empleadoCarnet->nombreCompleto;
								$data['id'] = 2;
								$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/empleado.png').'"><h3 class="text-danger text-center">Empleado agregado<br>Escanea el codigo QR del vehiculo</h3>';;
								$data['json'] = json_encode($empleado);
								echo json_encode($data);
							}else{
								$data['id'] = 0;
								$data['mensaje'] = '<h3 class="text-danger text-center">El carnet no se encuentra registrado</h3>';
								echo json_encode($data);
							}
						}
						else if(isset($idubicacion) && $idubicacion>0){
							$empleadoCarnet = empleados::where('codigo',$codigoEmpleado)->first();
							if(isset($empleadoCarnet))
							{
								$idempleado = $empleadoCarnet->id;
								$marcacionempleado = marcacionesempleados::where('idempleado',$idempleado)->where('fecha',$fecha)->orderby('id','asc')->get();
								$cantidad = $marcacionempleado->count();
								$marcacionempleado = $marcacionempleado->last();
								

								if(isset($marcacionempleado)&&$fecha==date('Y-m-d',strtotime($marcacionempleado->instante)))
								{
									$tipo=$marcacionempleado->tipo;
									if($tipo=="Entrada"){
										$tipo = "Salida";
									}else{
										$tipo = "Entrada";
									}
								}
								if($cantidad>=6){
									$data['id'] = 0;
									$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/alert.png').'"><h3 class="text-primary text-center">'.$empleadoCarnet->nombre1.', se ha alcanzado el número maximo de marcaciones por empleado para el dia '.date('d/m/Y').'</h3>';
									echo json_encode($data);
								}else{
									marcacionesempleados::create([
										'idempleado' => $idempleado,
										'idusuario' => $idusuario,
										'tipo' => $tipo,
										'fecha' => $fecha,
										'instante' => $instante,
										'idubicacion' => $idubicacion,
										'latitud' => $latitud,
										'longitud' => $longitud
									]);
									$data['id'] = 0;
									$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/ok.png').'"><h3 class="text-primary text-center">'.$empleadoCarnet->nombre1.
									' tu asistencia se registro correctamente!</h3><br><h3 class="text-primary text-center">'.$tipo.': '.date('h:i a',strtotime($instante)).'</h3>';
									echo json_encode($data);
								}
							}
							else{
								$data['id'] = 0;
								$data['mensaje'] = '<h3 class="text-danger text-center">El carnet no se encuentra registrado</h3>';
								echo json_encode($data);
							}
						}else{
							$data['id'] = 0;
							$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><h3 class="text-danger text-center">Por favor selecciona una ubicación válida!!</h3>';
							echo json_encode($data);
						}
					}else{
						$data['id'] = 0;
						$data['mensaje'] = $contenido;
						echo json_encode($data);
					}
				break;
				default:
					if(strpos($contenido,'https://maps.google.com')!==false){
						if(strpos($contenido,'ae=')==false){
							$data['id'] = 0;
							$data['mensaje'] = $contenido;
							echo json_encode($data);
						}else{
							//Si entra aqui es un codigo QR de Ubicacion
							$idubicacion = trim(explode('ae=',$contenido)[1]);
							$ubicacion = ubicacion::find($idubicacion);
							if(isset($ubicacion)){
								$ubicacion['id'] = $ubicacion->id;
								$ubicacion['ubicacion'] = $ubicacion->descripcion;
								$data['id'] = 1;
								$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/gps.png').'"><h3 class="text-danger text-center">Ubicación agregada<br>Escanea tu carnet</h3>';
								$data['json'] = json_encode($ubicacion);
								echo json_encode($data);
							}else{
								$data['id'] = 0;
								$data['mensaje'] = '<h3 class="text-danger text-center">La ubicación no se encuentra registrada</h3>';
								echo json_encode($data);
							}
							
						}
					}else if(strpos($contenido,'/api/ubicacion?id=')!==false){
						$split2 = explode('=',$contenido);
						if(isset($split2[1])){
							$idubicacion = trim($split2[1]);
							if(isset($idubicacion)){
								$request->contenido = "https://maps.google.com?ae=".$idubicacion;
								$this->escaner($request);
								break;
							}else{
								$data['id'] = 0;
								$data['mensaje'] = '<h3 class="text-danger text-center">La ubicación no se encuentra registrada</h3>';
								echo json_encode($data);
							}
						}else{
							$data['id'] = 0;
							$data['mensaje'] = '<h3 class="text-danger text-center">La ubicación no se encuentra registrada</h3>';
							echo json_encode($data);
						}
					}
					else if(strpos($contenido,'/api/asistencia?a=')!==false){
						$split2 = explode('=',$contenido);
						if(isset($split2[1])){
							$idempleado = str_replace("&b","",$split2[1]);
							$idempleado = trim($idempleado);
							if(isset($idempleado)){
								$empleado2 = empleados::find($idempleado);
								$codigo2 = $empleado2->codigo;
								if(isset($empleado2)){
									$request->contenido = "Carnet;".$codigo2;
									$this->escaner($request);
									break;
									/*
									$data['id'] = 0;
									$data['mensaje'] = "Carnet ".$empleado2->codigo;*/
								}else{
									$data['id'] = 0;
									$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><h3 class="text-danger text-center">Carnet no válido !!</h3>';
								}
							}else{
								$data['id'] = 0;
								$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><h3 class="text-danger text-center">Carnet no válido!!</h3>';
							}
						}else{
							$data['id'] = 0;
							$data['mensaje'] = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><h3 class="text-danger text-center">Carnet no válido!!</h3>';
						}
						echo json_encode($data);
					}else{
						$data['id'] = 0;
						$data['mensaje'] = $contenido;
						echo json_encode($data);
					}
				break;
			}
		}
	}
}
