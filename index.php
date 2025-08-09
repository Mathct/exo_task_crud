<?php

require_once 'config/database.php';
require_once 'function.php';

session_start();

$alltasks = [];
$errors = [];

//variables pour modal
$title = "";
$description = "";
$status = "";
$priority = "";

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
            $status = $task['status'];
            $priority = $task['priority'];
            
        }
    }
}


?>



<!-- PARTIE AFFICHAGE -->


<?php
include "header.php"
?>

<main>
    <section class="tasks">
        <?php echo showTask($alltasks); ?>
    </section>

    <div id="modal_container">
        <div id='modal' class="modal">
            <?php echo infoModal($title, $description, $status, $priority); ?>    
        </div>
    </div>


    <?php if($title != "") {
    ?>
        <script>
            //je place ce script ici afin d'être sur que ma modale soit créé dans le DOM
            var modal_container = document.getElementById('modal_container');
            modal_container.style.display = "block";
        </script>

    <?php
    }
    ?>

</main>

<?php
include "footer.php"
?>