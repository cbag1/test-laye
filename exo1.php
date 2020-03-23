<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Exercice 1</title>
  </head>
  <body>
    <?php
      set_time_limit(0); 
      include('fonctions.php');
     ?>
     <form action="" method="post">
     <!-- <img src="/serie" alt=""> -->
       <label for="nombre">Entrer un nombre inferieur à 10000</label>
        <input type="text" name="nombre" value="">
        <input type="submit" name="calculer" value="calculer">
     </form>
     


     <?php

      session_start();
      
        if (isset($_POST['calculer'])) {
          if(isset($_POST['nombre'])){
            if(is_numeric($_POST['nombre'])){

              if ($_POST['nombre']>=10000) {
                $_SESSION['tab']=[];
                $valeur=(int)$_POST['nombre'];
                $tab=premier($valeur);
                // var_dump($tab);

                $T=[
                  'inferieur'=>[],
                  'superieur'=>[]
                ];
                // Moyenne + ajout des nombres premiers inferieurs ou superieurs à la moyenne
                $moyenne=moyenne($tab);
                for ($i=0; $i < count($tab); $i++) {
                  if($tab[$i]<$moyenne){
                    $T['inferieur'][]=$tab[$i];
                  }else {
                    $T['superieur'][]=$tab[$i];
                  }
                }
                
                // Affichage par 100
                $nbpagesinf=(int)(count($T['inferieur'])/100);
                $nbpagessup=(int)(count($T['superieur'])/100);
                $_SESSION['nbpinf']=$nbpagesinf;
                $_SESSION['nbsup']=$nbpagessup;

                echo $nbpagesinf," ";
                echo $nbpagessup;


                if (empty($_SESSION['tab'])) {
                  $_SESSION['tab']=$T;
                  // Inferieur
                  echo "Inferieur";
                  affichertab(0,$T['inferieur']);
                  for ($i=1; $i <= $nbpagesinf; $i++) { 
                    echo "<a href='exo1.php?ind_inf=$i&ind_sup=0'>".$i." </a>";
                  }


                  // Superieur
                  echo "</br>";
                  echo "superieur";
                  affichertab(0,$T['superieur']);
                  for ($i=1; $i <= $nbpagessup; $i++) { 
                    echo "<a href='exo1.php?ind_sup=$i&ind_inf=0'>".$i." </a>";
                  }
                }
              }else{
                echo " Le nombre entré est inferieur à 10000";
              }
                   
      
            }else{
              echo "Entrer une valeur numerique please";
            }
          }else {
            echo "Le champs est vide";
          }
        }


        // Pour faire la pagination avec la methode GET et la recuperation de la session

        if(isset($_GET['ind_inf']) && isset($_GET['ind_sup'])){
          $ind_inf=(int)$_GET['ind_inf'];
          $ind_sup=(int)$_GET['ind_sup'];
          
          
          $tab=$_SESSION['tab'];

          echo " INferieur";
          if($ind_inf==$_SESSION['nbpinf']){
            affichertab(($ind_inf*100),$tab['inferieur']);
            
          }else{
            affichertab(($ind_inf*100),$tab['inferieur']);
          }
            for ($i=1; $i <= $_SESSION['nbpinf']; $i++) { 
              echo "<a href='exo1.php?ind_inf=$i&ind_sup=$ind_sup'>".$i." </a>";
            }
            echo '</br>';
          echo " Superieur";
          if($ind_sup==$_SESSION['nbsup']){
            affichertab(($ind_sup*100),$tab['superieur']);
          }else{
            affichertab(($ind_sup*100),$tab['superieur']);
          }

          for ($i=1; $i <= $_SESSION['nbsup']; $i++) { 
            echo "<a href='exo1.php?ind_sup=$i&ind_inf=$ind_inf'>".$i." </a>";
          }
          
        }
      ?>
  </body>
</html>
