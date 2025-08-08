<?php

require_once 'config/database.php';
session_start();

$alltasks = [];
$errors = [];
$title = "";
$description = "";
$status = "";
$priotity = "";

try{

        // on lance la connexion à la BD
        $pdo = dbConnexion();

        //preparation et execution de la requete
        $sql = "SELECT * FROM tasks";
        $request = $pdo->prepare($sql);
        $request->execute();

        //recuperation du resultat sous forme de tableau associatif
        $tasks = $request->fetchAll(); 

        if($tasks)
        {
          $alltasks = $tasks;
        }

        else{ 
          $errors[] = "aucune données";
        }

      } catch (PDOException $e) {
        $errors[] = "Erreur durant la connexion à la bd: ".$e->getMessage();
      }



if(isset($_GET['task']))
{ 
    foreach($alltasks as $task)
    {
        if('task_'.$task['id'] == $_GET['task'])
        {
            $title = $task['title'];
            $description = $task['description'];
            
            
        }
    }
}





?>


<?php
include "header.php"
?>

<main>
    <section class="tasks">

        <?php
        foreach($alltasks as $task)
        {
        ?> 

                <div id="task_<?= $task['id']?>" class="task">
                    <div class="title"><?= $task['title']?></div>
                    
                    <?php
                        if($task['status']=="terminée")
                        {
                    ?>
                        <div class="status" style="color: green;"><?= $task['status']?></div>
                    <?php
                        }
                    ?>

                    <?php
                        if($task['status']=="en cours")
                        {
                    ?>
                        <div class="status" style="color: orange;"><?= $task['status']?></div>
                    <?php
                        }
                    ?>

                    <?php
                        if($task['status']=="à faire")
                        {
                    ?>
                        <div class="status" style="color: red;"><?= $task['status']?></div>
                    <?php
                        }
                    ?>


                    <?php
                        if($task['priority']=="basse")
                        {
                    ?>
                        <div class="priority" style="background-color: green;"><?= $task['priority']?></div>
                    <?php
                        }
                    ?>

                    <?php
                        if($task['priority']=="moyenne")
                        {
                    ?>
                        <div class="priority" style="background-color: orange;"><?= $task['priority']?></div>
                    <?php
                        }
                    ?>
                    <?php
                        if($task['priority']=="haute")
                        {
                    ?>
                        <div class="priority" style="background-color: red;"><?= $task['priority']?></div>
                    <?php
                        }
                    ?>

                </div>

        <?php
        }
        ?>


    </section>


    <div id='modal' class="modal">
        <h2><?php echo $title; ?></h2>
        <div><?php echo $description; ?></div>
    </div>

    <?php if($title != "")
    {
    ?>
            <script>
                var modal = document.getElementById('modal');
                modal.style.display = "flex";
            </script>

    <?php
    }
    ?>


</main>

<?php
include "footer.php"
?>