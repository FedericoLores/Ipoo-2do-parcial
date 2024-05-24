<?php
include_once("Categoria.php");
include_once("Torneo.php");
include_once("Equipo.php");
include_once("Partido.php");
include_once("PartidoFutbol.php");
include_once("PartidoBasquet.php");

function cantEquipos($objTorneo){
    $colNombresEquipos = []; //para asegurarnos de no contar ningun equipo dos veces
    $colPartidos = $objTorneo->getColPartidos();
    $colNombresEquipos[] = $colPartidos[0]->getObjEquipo1()->getNombre();
    foreach($colPartidos as $partido){
        $i=0;
        $seRepite = false;
        while($i<count($colNombresEquipos) && !$seRepite){
            if($colNombresEquipos[$i] == $partido->getObjEquipo1()->getNombre()){
                $seRepite = true;
            }
            $i++;
        }
        if(!$seRepite){ //si no se repite, lo agregamos a la lista
            $colNombresEquipos[] = $partido->getObjEquipo1()->getNombre();
        }
        while($i<count($colNombresEquipos) && !$seRepite){//repetimos logica para equipo 2
            if($colNombresEquipos[$i] == $partido->getObjEquipo2()->getNombre()){
                $seRepite = true;
            }
            $i++;
        }
        if(!$seRepite){ //si no se repite, lo agregamos a la lista
            $colNombresEquipos[] = $partido->getObjEquipo2()->getNombre();
        }
    }
    $cant = count($colNombresEquipos);
    return $cant;
}

$catMayores = neW Categoria(3,'Mayores');
$catJuveniles = neW Categoria(2,'juveniles');
$catMenores = neW Categoria(1,'Menores');

$objE1 = neW Equipo("Equipo Uno", "Cap.Uno",1,$catMayores);
$objE2 = neW Equipo("Equipo Dos", "Cap.Dos",2,$catMayores);

$objE3 = neW Equipo("Equipo Tres", "Cap.Tres",3,$catJuveniles);
$objE4 = neW Equipo("Equipo Cuatro", "Cap.Cuatro",4,$catJuveniles);

$objE5 = neW Equipo("Equipo Cinco", "Cap.Cinco",5,$catMayores);
$objE6 = neW Equipo("Equipo Seis", "Cap.Seis",6,$catMayores);

$objE7 = neW Equipo("Equipo Siete", "Cap.Siete",7,$catJuveniles);
$objE8 = neW Equipo("Equipo Ocho", "Cap.Ocho",8,$catJuveniles);

$objE9 = neW Equipo("Equipo Nueve", "Cap.Nueve",9,$catMenores);
$objE10 = neW Equipo("Equipo Diez", "Cap.Diez",9,$catMenores);

$objE11 = neW Equipo("Equipo Once", "Cap.Once",11,$catMayores);
$objE12 = neW Equipo("Equipo Doce", "Cap.Doce",11,$catMayores);

$torneo = new Torneo(100000);

$objBasquet1 = new PartidoBasquet(11, "2024-05-05", $objE7, 80, $objE8, 120, 7);
$objBasquet2 = new PartidoBasquet(12, "2024-05-06", $objE9, 81, $objE10, 110, 8);
$objBasquet3 = new PartidoBasquet(13, "2024-05-07", $objE11, 115, $objE12, 85, 9);

$objFutbol1 = new PartidoFutbol(14, "2024-05-07", $objE1, 3, $objE2, 2, $catMayores);
$objFutbol2 = new PartidoFutbol(15, "2024-05-08", $objE3, 0, $objE4, 1, $catJuveniles);
$objFutbol3 = new PartidoFutbol(15, "2024-05-09", $objE5, 2, $objE6, 3, $catMayores);

$puntoA= $torneo->ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol');
if($puntoA){
    $mensaje = "Se pudo registrar el partido.";
} else{
    $mensaje = "No se pudo registrar el partido.";
}
echo $mensaje . "\n Cantidad de equipos: " . cantEquipos($torneo);

$puntoB= $torneo->ingresarPartido($objE11, $objE11, '2024-05-23', 'basquetbol');
if($puntoB){
    $mensaje = "Se pudo registrar el partido.";
} else{
    $mensaje = "No se pudo registrar el partido.";
}
echo $mensaje . "\n Cantidad de equipos: " . cantEquipos($torneo);

$puntoC= $torneo->ingresarPartido($objE9, $objE10, '2024-05-23', 'basquetbol');
if($puntoB){
    $mensaje = "Se pudo registrar el partido.";
} else{
    $mensaje = "No se pudo registrar el partido.";
}
echo $mensaje . "\n Cantidad de equipos: " . cantEquipos($torneo);

//punto D
$ganadores= $torneo->darGanadores("basquet");
if($ganadores == null){
    echo "No hay ganadores.\n";
} else {
    foreach($ganadores as $ganador){
        if(count($ganador) == 1){
            echo $ganador[0];
        }else{
            echo $ganador[0];
            echo $ganador[1];
        }
    }
}

//punto E
$ganadores= $torneo->darGanadores("futbol");
if($ganadores == null){
    echo "No hay ganadores.\n";
} else {
    foreach($ganadores as $ganador){
        if(count($ganador) == 1){
            echo $ganador[0];
        }else{
            echo $ganador[0];
            echo $ganador[1];
        }
    }
}

//punto F
$premio = $torneo->calcularPremioPartido(count($torneo->getColPartidos()) - 1);
if(count($premio["equipoGanador"]) == 1){
    echo "Equipo ganador: " . $premio["equipoGanador"] . "\n";
} else{
    echo "Equipos ganadores: " . $premio["equipoGanador"][0] . "\n" . $premio["equipoGanador"][1] . "\n";
}

$premio = $torneo->calcularPremioPartido(count($torneo->getColPartidos()));
if(count($premio["equipoGanador"]) == 1){
    echo "Equipo ganador: " . $premio["equipoGanador"] . "\n";
} else{
    echo "Equipos ganadores: " . $premio["equipoGanador"][0] . "\n" . $premio["equipoGanador"][1] . "\n";
}

echo $torneo;


?>
