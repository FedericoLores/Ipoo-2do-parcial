<?php
class PartidoBasquet extends Partido{
    private $cantInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfraccionesCnstr, $coefPenalizacionCnstr = 75){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones = $cantInfraccionesCnstr;
        $this->coefPenalizacion = $coefPenalizacionCnstr;
    }

    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }

    public function setCantInfracciones($cantInfraccionesNew){
        $this->cantInfracciones = $cantInfraccionesNew;
    }

    public function getCoefPenalizacion(){
        return $this->coefPenalizacion;
    }

    public function setCoefPenalizacion($coefPenalizacionNew){
        $this->coefPenalizacion = $coefPenalizacionNew;
    }

    public function __toString(){
        return parent::__toString() . "Cantidad de infracciones: " . $this->getCantInfracciones() . "\nCoeficiente de penalización: " . $this->getCoefPenalizacion() . "\n"."--------------------------------------------------------"."\n";
    }

    public function coeficientePartido(){
        $coef= $this->getCoefBase() - ($this->getCoefPenalizacion() * $this->getCantInfracciones());
    }

}
?>