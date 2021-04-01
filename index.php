<?php
    include_once "survey.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleform.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <title>Document</title>
</head>
<body>
<div class="box">
   
   <form action="#" method="POST">
    <?php

    $survey=new Survey();
    $showResults = false; //bool para mostrar uno u otro

    if(isset($_POST["lenguajeprog"])){
        
        $survey->setOptionSelected($_POST["lenguajeprog"]);
        $survey->vote();
        $showResults = true;
        
    }
    $resultado = $survey->showResults();
    ?>

       <h2>What is your favorite programming language?</h2>
    <?php
       //only 4 answers

       $percentToGraph=array(10,10,10,10);
       
       
       

       if($showResults){
           $resultado = $survey->showResults();
           echo "<h2>" . $survey->getTotalVotes() . " Total votes </h2>";

           foreach($resultado as $lenguaje){

               $porcentaje = $survey->getPercentageVotes($lenguaje["votos"]);
               $cord = $survey->getIndex($lenguaje["id"]);
               $percentToGraph[$cord-1]=$porcentaje;

           }
           include("graph.php");
           
       }else{
           include("form.php");
       }
       
    ?>
        
        
   </form>
   
   
</div>
<?php
    $db = new DB();
    $db-> connect();
?>

</body>
</html>



