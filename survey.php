<?php
// clase para votar y mostrar resultados
include_once "db.php";

class Survey extends DB{
    private $totalVotes;
    private $optionSelected;

    public function setOptionSelected($option){
        // asigna a la variable descrita a continuacion lo que picamos
        $this ->optionSelected = $option;
    }
    public function getOptionSelected(){
        //devuelve el valor asignado
        return $this->optionSelected;
    }
    public function vote(){
        //pdo actualizar tabla de valores de usuario preparamos query y evitamos sql inyection
        $query = $this->connect()->prepare("UPDATE ques SET votos = votos +1 WHERE lenguaje = :lenguaje ");
        //ahora a cambiar el valor temporal :lenguaje por un valor real de modo que
        $query->execute(["lenguaje" => $this ->optionSelected]);
        //esto comprende validacion dado que debe de ser ese valor particular y no otra sentencia sql

    }
    public function showResults(){
        //no se utiliza prepare por que es una consulta interna y no demanda riesgo
        return $this->connect()->query("SELECT * FROM ques ");
    }
    public function getTotalVotes(){
        $query = $this->connect()->query("SELECT SUM(votos) AS votos_totales FROM ques");
        //obtener el resultado de query anterior
        $this->totalVotes =$query->fetch(PDO::FETCH_OBJ)->votos_totales;
        //esto ultimo se ejecuto asi por que devuelve una sola celda, un numero
        return $this->totalVotes;
    }

    public function getPercentageVotes($votes){
        return round(($votes / $this->totalVotes)*100, 0);
    }

    public function getIndex($Ind){
        return $Ind;
    }

}
?>