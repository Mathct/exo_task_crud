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
$date_ex = "";
$date_create = "";
$date_update = "";

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


// SHOW ONE TASK

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
            $date_ex = $task['due_date'];
            $date_create = $task['created_at'];
            $date_update = $task['updated_at'];
            
        }
    }
}


// CREATE

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // Traitement du formulaire

    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $status = 'à faire';
    $priority = $_POST['priority'] ?? '';
    $date_ex= $_POST['date'] ?? '';
    $date_create = date('Y-m-d H:i:s');
    $date_update = date('Y-m-d H:i:s');

    //verification vide + nettoyage + gestion des erreurs


    // envoi des données

    // on lance la connexion à la BD
    $pdo = dbConnexion();

    // on va injecter les données dans le BD

    $sql = "INSERT INTO tasks (title, description, status, priority, due_date, created_at, updated_at) VALUES (:title, :description, :status, :priority, :due_date, :created_at, :updated_at)";

    $newTask = $pdo->prepare($sql);

    $newTask->execute([
    ':title'  => $title,
    ':description'      => $description,
    ':status'      => $status,
    ':priority'      => $priority,
    ':due_date'      => $date_ex,
    ':created_at'      => $date_create,
    ':updated_at'      => $date_update,
    
    ]);

    //Redirection pour éviter le re-post lors du refresh
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit(); 

    
}


?>



<!-- PARTIE HTML -->


<?php
include "header.php"
?>

<main>
    <section class="tasks">
        <?php echo showTask($alltasks); ?>
    </section>

    <div id="modal_container">
        <div id='modal' class="modal">
            <?php echo infoModal($title, $description, $status, $priority, $date_ex, $date_create, $date_update); ?>    
        </div>
    </div>


    <?php if($title != "") {
    ?>
        <script>
            //je place ce script ici afin d'être sur que ma modal soit créée dans le DOM
            var modal_container = document.getElementById('modal_container');
            modal_container.style.display = "block";
        </script>

    <?php
    }
    ?>

    <div id="modalcreate_container">
        <div id='modalcreate' class="modal">
        <i class='closecreate fa-regular fa-circle-xmark'></i>
        <h2>Créer une tâche</h2>

        <form action="" method="POST">
            
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" maxlength="255" required>
            </div>
            

            <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description"></textarea>
            </div>

            <div>
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div>
            <label for="priority">Priorité :</label>
            <select id="priority" name="priority" required>
            <option value="">-- Choisir --</option>
            <option value="basse">basse</option>
            <option value="moyenne">moyenne</option>
            <option value="haute">haute</option>
            </select>
            </div>

            <div>
            <button type="submit">Envoyer</button>
            <button type="reset">Réinitialiser</button>
            </div>
            
        </form>
                
        </div>
    </div>


</main>

<?php
include "footer.php"
?>