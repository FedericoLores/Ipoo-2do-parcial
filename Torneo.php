<?php
class Torneo {
    private $colPartidos;
    private $importePremio;

    public function __construct($importePremioCnstr){
        $this->colPartidos = [];
        $this->importePremio = $importePremioCnstr;
    }

    public function getColPartidos(){
        return $this->colPartidos;
    }

    public function setColPartidos($colPartidosNew){
        $this->colPartidos = $colPartidosNew;
    }

    public function getUnPartido($indice){
        return $this->colPartidos[$indice];
    }

    public function setUnPartido($indice, $unPartidoNew){
        $this->colPartidos[$indice] = $unPartidoNew;
    }

    public function getImportePremio(){
        return $this->importePremio;
    }

    public function setImportePremio($importePremioNew){
        $this->importePremio = $importePremioNew;
    }

    public function __toString(){
        $string="";
        $numPartido=1;
        foreach($this->getColPartidos() as $partido){
            $string .= "partido " . $numPartido . ": " . $partido . "\n";
            $numPartido++;
        }
        $string .= "importe del premio: " . $this->importePremio . "\n";
        return $string;
    }
    
    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipoPartido){
        $id = count($this->getColPartidos());
        $seRegistro=false;
        if($objEquipo1 != $objEquipo2){ //se revisa que no sea el mismo equipo
            if($objEquipo1->getCantJugadores() == $objEquipo2->getCantJugadores()){
                if($tipoPartido == "futbol"){
                    if($objEquipo1->getObjCategoria() == $objEquipo2->getObjCategoria()){
                        $partido = new PartidoFutbol($id, $fecha, $objEquipo1, 0, $objEquipo2, 0, $objEquipo1->getObjCategoria());
                        $this->setUnPartido($this->getColPartidos(), $partido);
                        $seRegistro=true;
                    }
                }else{ //no se revisa porque solo puede ser futbol o basquet
                    $partido = new PartidoBasquet($id, $fecha, $objEquipo1, 0, $objEquipo2, 0, 0);
                    $this->setUnPartido($id, $partido);
                    $seRegistro=true;
                }
            }
        }
        return $seRegistro;
    }

    public function darGanadores($deporte){
        $deporte = strtolower($deporte);
        $ganadores = [];
        if($deporte = "futbol"){
            foreach($this->getColPartidos() as $partido){
                if($partido instanceof PartidoFutbol){
                    $ganador =$partido->darEquipoGanador();
                    if(count($ganador) == 1){
                        $ganadores[] = $ganador[0];
                    } else {
                        $ganadores[] = $ganador[0];
                        $ganadores[] = $ganador[1];
                    }
                }
            }
        }else{
            foreach($this->getColPartidos() as $partido){
                if($partido instanceof PartidoBasquet){
                    $ganador =$partido->darEquipoGanador();
                    if(count($ganador) == 1){
                        $ganadores[] = $ganador[0];
                    } else {
                        $ganadores[] = $ganador[0];
                        $ganadores[] = $ganador[1];
                    }
                }
            }
        }
        if (count($ganadores) == 0){
            $ganadores = null;
        }
        return $ganadores;
    }

    public function calcularPremioPartido($objPartido){
        $ganador = $objPartido->darEquipoGanador();
        $premio = $objPartido->coeficientePartido() * $this->importePremio;
        $arregloPremio=["equipoGanador"=> $ganador, "premioPartido"=>$premio];
        return $arregloPremio;
    }



}
?>