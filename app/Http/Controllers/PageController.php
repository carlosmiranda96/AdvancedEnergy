<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Mail\Registro;
use Maatwebsite\Excel\Facades\Excel;
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
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
	public function __construct()
	{
		date_default_timezone_set('America/El_Salvador');
	}
	public function export()
	{
		//return Excel::dowload(new UsersExport,'users.xlsx');
		$export = new UsersExport();
		return $export->download('users.pdf');
	}
	public function loadaplicacion()
	{
		$idusuario = session('user_id');
        $empleado = empleadoUser::where('idusuario',$idusuario)->first();
		$idempleado = 0;
		$a=0;
		$b=0;
        if($empleado){
			$a = $empleado->idempleado;
			$datosempleado = empleados::find($a);
			$b = $datosempleado->toquen;
        }
		$url = route('asistencia',['a'=>$a,'b'=>$b]);
		return view('aplicacion.cargar',compact('url'));
	}
	//API APLICACION ASISTENCIA
	public function asistencia(Request $request)
	{
		$id = $request->a;
		$toquen = $request->b;
		if(isset($id)){
			$empleado = empleados::where('id',$id)->where('toquen',$toquen)->first();
			if(isset($empleado))
			{
				$email = '';
				$password = '';
				$email = $request->cookie('email');
				$password = $request->cookie('password');
				return view('aplicacion.aplicacion',compact('empleado','email','password'));
			}else{
				abort(404);
			}
		}else{
			abort(404);
		}
	}
	//API LECTORQR
	public function lectorqr(Request $request)
	{
		$idvehiculo = $request->a;
		$toquen = $request->b;
		$idubicacion = $request->c;
		$ubicacion = ubicacion::find($idubicacion);
		$empleado = empleados::where('toquen',$toquen)->first();
		$idvehiculo = $request->a;
		if(!$idvehiculo){
			$idvehiculo = 0;
		}
		return view('qr.escaner',compact('empleado','idvehiculo','ubicacion'));
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
		$validar = $this->validarUser($request->email,$request->password,$request);
		if($validar=="1")
		{
			$usuario = User::where('email',$request->email)->first();
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
			}else{
				$cookie1 = Cookie::forget('email');
				$cookie2 = Cookie::forget('password');
			}
			return redirect('inicio')->withCookie($cookie1)->withCookie($cookie2);
		}else{
			return redirect()->route('login')->with('mensaje',$validar);		
		}		
	}
	public function validarUser($email,$password,Request $request)
	{
		$usuario = User::where('email',$email)->first();
		if(isset($usuario))
		{
			if($usuario->estado==1){
				$decrypted = Crypt::decryptString($usuario->password);
				if($decrypted==$password && $password!='123456'){
					if(isset($request->crear))
					{
						session()->put('user_id', $usuario->id);
						session()->put('name', $usuario->name);
						session()->put('email',$usuario->email);
						session()->put('foto','storage/app/'.$usuario->foto);
						session()->put('idrol',$usuario->idrol);
						session()->put('menu_id',5);//Seleccionar menu inicio
						$empleadouser = empleadoUser::where('idusuario',$usuario->id)->first();
						if($empleadouser){
							return "1";
						}else{
							return "2";
						}
					}else{
						return "1";	
					}	
				}else{
					return "La clave ingresada es incorrecta";
				}
			}else{
				return "Usuario no activo!!";
			}
		}else{
			return "Usuario ingresado es incorrecto";		
		}
	}
	public function validarsesion(){
		if(session('user_id'))
		{
			$empleadouser = empleadoUser::where('idusuario',session('user_id'))->first();
			if($empleadouser){
				return 1;
			}else{
				return 2;
			}
		}else{
			echo 0;
		}
	}
	//Crea la sesion al dar clic en una opcion del menu
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
		$empleado = $this->verificarUserEmpleado();
		return view('inicio',compact('empleado'));
	}
	public function verificarUserEmpleado()
	{
		$idusuario = session('user_id');
		$empleado = empleadoUser::where('idusuario',$idusuario)->first();
		if(isset($empleado)){
			return true;
		}else{
			return false;
		}
	}
	public function recordar()
	{
		return view('recordar');
	}
	public function general(){
		return view('general.general');
	}
	public function rrhh(){
		return view('rrhh.rrhh');
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
			$datos[$contador]['descripcion'] = 'Escanea QR';
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
	public function obtenerParametros($url)
	{
		$arreglo = array();
		$split = explode('?',$url);
		if(isset($split[1])){
			$parametros = $split[1];
			$split2 = explode('&',$parametros);
			$contador = 0;
			foreach($split2 as $item)
			{
				$split3 = explode('=',$item);
				if(isset($split3[1])){
					$arreglo[$contador]['id'] = $split3[0];
					$arreglo[$contador]['valor'] = $split3[1];
					$contador++;
				}
			}
		}
		return $arreglo;
	}
	public function lector($contenido)
	{
		//https://www.google.com
		$sitiohttps = strpos($contenido, 'https://');
		$sitiohttp = strpos($contenido, 'http://');	
		if($sitiohttps!==false){
			$mensaje = 'Click en el enlace para acceder<br><a href="'.$contenido.'" target="_blank">'.$contenido.'</a>';
		}else if($sitiohttp!==false){
			$mensaje = 'Click en el enlace para acceder<br><a href="'.$contenido.'" target="_blank">'.$contenido.'</a>';
		}else{
			$mensaje = $contenido;
		}
		$data['id'] = 0;
		$data['mensaje'] = $mensaje;
		return $data;
	}
	public function escaner(Request $request)
	{
		$contenido = $request->contenido;
		$idempleado = $request->idempleado;
		$idempleadoinicio = $request->idempleadoinicio;
		$latitud = $request->latitud;
		$longitud = $request->longitud;
		$idubicacion = $request->idubicacion;
		$idvehiculo = $request->idvehiculo;
		$opcion = $request->opcion;

		$empleadouser = empleadoUser::where('idempleado',$idempleadoinicio)->first();
		if($empleadouser){
			$idusuario = $empleadouser->idusuario;
		}else{
			$idusuario = 1;
		}

		$data['id'] = 0;
		$data['mensaje'] = 'Sin respuesta';
		//Ejemplo de url de carnet https://192.168.2.98/api/asistencia?a=5&b=eyJpdiI6IjRMZ2pmTmpt#
		//Ejemplo de url de vehiculo https://192.168.2.98/api/qr?a=1
		//Ejemplo de url de ubicacion https://192.168.2.98/api/qr?c=1

		//0 = enviar mensaje a pantalla
		//1 = Cargar ubicacion
		//2 = Cargar codigo carnet
		//3 = Cargar vehiculo

		$error = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><div class="h3 text-danger text-center">';
		$alert = '<img class="col-6 offset-3" src="'.asset('img/alert.png').'"><div class="h3 text-primary text-center">';
		$success = '<img class="col-6 offset-3" src="'.asset('img/ok.png').'"><div class="h3 text-primary text-center">';

		$ubicacionkey = strpos($contenido, 'api/qr?c=');
		$vehiculokey = strpos($contenido, 'api/qr?a');
		$carnetkey = strpos($contenido, 'api/asistencia?a=');

		switch($opcion)
		{
		case 'vehiculo':
			//Se debe permitir unicamente que se escnee, Carnet y vehiculo
			//Para vehiculo se debe cumplir, Tener un idempleado, idvehiculo
			if ($ubicacionkey !== false)
			{
				//Es ubicacion
				$parametros = $this->obtenerParametros($contenido);
				if($parametros && isset($parametros[0]['valor']))
				{
					$idubicacion = $parametros[0]['valor'];
					$ubicacion = ubicacion::find($idubicacion);
					if(isset($ubicacion)){
						$data['id'] = 1;
						$data['mensaje'] = $success.'Ubicación '.$ubicacion->descripcion.' se agregó, cierra la notificación y escanea tu carnet</h3>';
						$ubi['id'] = $ubicacion->id;
						$ubi['ubicacion'] = $ubicacion->descripcion;
						$data['json'] = json_encode($ubi);
					}else{
						$data['id'] = 0;
						$data['mensaje'] = $error.'La ubicación no se encuentra registrada</div>';
					}
				}else{
					//LECTOR QR
					$data = $this->lector($contenido);
				}
			}else if ($carnetkey !== false)
			{
				//Se debe validar que exista idvehiculo
				//Se debe validar que el qr de carnet sea valido

				if($idvehiculo>0)
				{
					$vehiculo = equipostrabajo::find($idvehiculo);
					if(isset($vehiculo))
					{
						$idequipotrabajo = $vehiculo->id;
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$instante = date('Y-m-d H:i:s');
						//Asignar empleado escaneado
						$parametros = $this->obtenerParametros($contenido);
						if($parametros && isset($parametros[1]['valor']))
						{
							$idempleado = $parametros[0]['valor'];
							$toquen = $parametros[1]['valor'];
							$empleado = empleados::find($idempleado)->where('toquen',$toquen)->first();
							if($empleado){
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
									$data['mensaje'] = $error.'Vehiculo fue asignado hace '.$tiempo.'</div><br><h5 class="text-danger text-center">Espera 15 min para volver a escanear el mismo codigo</h5>';
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
									$data['mensaje'] = $success.'Vehiculo asignado</h3>
									<h6 class="text-primary text-center">Por favor llenar el siguiente formulario para finalizar el registro</h6>
									<a href="'.route('api.form.vehiculo',['id'=>$historial->id]).'"><div class="btn btn-primary col-12"><i class="fas fa-share-square"></i> Formulario</div></a>';
								}
							}else{
								$data['id'] = 0;
								$data['mensaje'] = $error.'Empleado no válido, por favor seleccionar empleado o escanear QR de carnet</div>';
							}	
						}
					}else{
						$data['id'] = 0;
						$data['mensaje'] = $error.'Equipo no está registrado</div>';
					}
				}else{
					$data['id'] = 0;
					$data['mensaje'] = $error.'Debes escanear primero el QR del vehiculo, cierra la ventana y escanealo!</div>';
				}
			}else if ($vehiculokey !== false)
			{
				//Es QR VEHICULO
				$parametros = $this->obtenerParametros($contenido);
				if($parametros && isset($parametros[0]['valor']))
				{
					$idvehiculo = $parametros[0]['valor'];
					$vehiculo = equipostrabajo::find($idvehiculo);
					$data['id'] = 3;
					$data['mensaje'] = $success.'Se ha seleccionado el vehiculo '.$vehiculo->codigo.', cierra la ventana y escanea tu carnet!';
					$data['idvehiculo'] = $vehiculo->id;
				}else{
					//LECTOR QR
					$data = $this->lector($contenido);
				}
			}else{
				$data = $this->lector($contenido);
			}
			break;
		case 'asistencia':
			//Se debe permitir unicamente que se escanee, Carnet y Ubicación
			//Si es vehiculo
			//Si es carnet se debe cumplir, idubicacion
			if ($ubicacionkey !== false)
			{
				//Es ubicacion
				$parametros = $this->obtenerParametros($contenido);
				if($parametros && isset($parametros[0]['valor']))
				{
					$idubicacion = $parametros[0]['valor'];
					$ubicacion = ubicacion::find($idubicacion);
					if(isset($ubicacion)){
						$data['id'] = 1;
						$data['mensaje'] = $success.'Ubicación '.$ubicacion->descripcion.' se agregó, cierra la notificación y escanea tu carnet</h3>';
						$ubi['id'] = $ubicacion->id;
						$ubi['ubicacion'] = $ubicacion->descripcion;
						$data['json'] = json_encode($ubi);
					}else{
						$data['id'] = 0;
						$data['mensaje'] = $error.'La ubicación no se encuentra registrada</div>';
					}
				}else{
					//LECTOR QR
					$data = $this->lector($contenido);
				}
			}else if($carnetkey !== false)
			{
				//Es carnet
				$parametros = $this->obtenerParametros($contenido);
				$idcarnet = 0;
				$toquen = 0;
				if($parametros && isset($parametros[1]['valor']))
				{
					$idcarnet = $parametros[0]['valor'];
					$toquen = $parametros[1]['valor'];
					if($idubicacion>0)
					{
						$hora = date('H:i:s');
						$instante = date('H:i:s');
						$fecha = date('Y-m-d');
						$tipo = "Entrada";
						if($hora>date('H:i:s',strtotime('12:00:00')))
						{
							$tipo = "Salida";
						}
						$empleadoCarnet = empleados::where('id',$idcarnet)->where('toquen',$toquen)->first();
						if($empleadoCarnet)
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
								$data['mensaje'] = $error.$empleadoCarnet->nombre1.', has alcanzado el número maximo de marcaciones para este dia</div>';
							}else{
								$ubicacion = ubicacion::find($idubicacion);
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
								$data['mensaje'] = $success.$empleadoCarnet->nombre1.' tu asistencia se registro en '.$ubicacion->descripcion.'!</div><br><h3 class="text-primary text-center">Hora: '.date('h:i a',strtotime($instante)).'<br>Tipo: '.$tipo.'</h3>';
							}
						}else{
							$data['id'] = 0;
							$data['mensaje'] = $error.'El carnet no no es válido</div>';
						}
					}else{
						$data['id'] = 0;
						//$data['mensaje'] = $error.'<strong>Ubicación no válida</strong><br>Por favor escanea el QR de la ubicación y luego vuelve a escanear tu carnet!</div>';
						$data['mensaje'] = $error.'<strong>Ubicación no válida</strong><br></div>';
					}
				}else{
					//LECTOR QR
					$data = $this->lector($contenido);
				}
			}else if($vehiculokey !== false){
				//Es QR VEHICULO
				$parametros = $this->obtenerParametros($contenido);
				if($parametros && isset($parametros[0]['valor']))
				{
					$idvehiculo = $parametros[0]['valor'];
					$vehiculo = equipostrabajo::find($idvehiculo);
					$data['id'] = 3;
					$data['mensaje'] = $success.'Se ha seleccionado el vehiculo '.$vehiculo->codigo.', cierra la ventana y escanea tu carnet!';
					$data['idvehiculo'] = $vehiculo->id;
				}else{
					//LECTOR QR
					$data = $this->lector($contenido);
				}
			}else{
				//LECTOR QR
				$data = $this->lector($contenido);
			}		
			break;
		}
		//IMPRIMIR JSON
		echo json_encode($data);
	}
	public function escanerCarnet(Request $request)
	{
		$error = '<img class="col-6 offset-3" src="'.asset('img/cancel.png').'"><br><br><div class="h3 text-danger text-center">';
		$alert = '<img class="col-6 offset-3" src="'.asset('img/alert.png').'"><div class="h3 text-primary text-center">';
		$success = '<img class="col-6 offset-3" src="'.asset('img/ok.png').'"><div class="h3 text-primary text-center">';

		$url = $request->contenido.'&b='.$request->b;
		$carnetkey = strpos($url, 'api/asistencia?a=');
		if($carnetkey !== false)
		{
			//Es carnet
			$parametros = $this->obtenerParametros($url);
			$idempleado = 0;
			$toquen = 0;
			$idusuario = session('user_id');
			if($parametros && isset($parametros[1]['valor']))
			{
				$idempleado = $parametros[0]['valor'];
				$toquen = $parametros[1]['valor'];
				$empleadoCarnet = empleados::where('id',$idempleado)->where('toquen',$toquen)->first();
				if($empleadoCarnet)
				{
					$empleadouser = empleadoUser::where('idempleado',$idempleado)->first();
					if(!$empleadouser){
						//Asignar usuario a empleado
						$empleado = new empleadoUser;
						$empleado->idusuario = $idusuario;
						$empleado->idempleado = $idempleado;
						$empleado->save();
						echo "1";
					}else{
						echo $error."El carnet ya fue configurado con otro usuario!! <br>Contacta al administrador</h3>";
					}
				}else{
					echo $alert."Codigo QR no es válido</h3>";
				}
			}
		}
	}
	public function marcaciones()
	{
		$marcacionesempleados = marcacionesempleados::join('empleados','idempleado','empleados.id')->join
		('ubicacions','idubicacion','ubicacions.id')->select('marcacionesempleados.*','empleados.nombreCompleto as empleado','ubicacions.descripcion')->where('tipo','Entrada')->get();
		return view('rrhh.marcaciones.show',compact('marcacionesempleados'));
	}
	public function pruebaemail()
	{
		//return new Registro(7);
		//Mail::to('amiranda@ae-energiasolar.com')->send(new Registro(7));
	}
	public function validar(Request $request)
	{
		$idusuario = $request->a;
		$correo = $request->b;
		$toquen = $request->c;
		$usuario = User::where('email',$correo)->where('remember_token',$toquen)->find($idusuario);
		if(isset($usuario) && isset($usuario->remember_token)){
			$valido = true;
		}else{
			$valido = false;
		}
		return view('validarRegistro',compact('valido','idusuario','correo'));
	}
}