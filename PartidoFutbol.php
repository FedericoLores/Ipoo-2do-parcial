<?php
class PartidoFutbol extends Partido{
    private $objCategoria;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $objCategoriaCnstr){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->objCategoria = $objCategoriaCnstr;
    }

    public function getObjCategoria(){
        return $this->objCategoria;
    }

    public function setObjCategoria($objCategoriaNew){
        $this->objCategoria = $objCategoriaNew;
    }

    public function __toString(){
        return parent::__toString() . "Categoria: " . $this->objCategoria . "\n"."--------------------------------------------------------"."\n";
    }

    public function coeficientePartido(){
        $coefBase = parent::coeficientePartido();
        switch($this->getObjCategoria()){
            case "coef_Menores":
                $coefCategoria = 0.13;
                break;
            case "coef_juveniles":
                $coefCategoria = 0.19;
                break;
            case "coef_Mayores":
                $coefCategoria = 0.27;
                break;
        }
        $coefTotal = $coefBase * $coefCategoria;
        return $coefTotal;
    }

}
?>