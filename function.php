<?php

function showTask($alltasks)
{
    
    $return = '';
    foreach ($alltasks as $task) {
        $status = '';
        $priority = '';

        if ($task['status'] == "terminée") {
            $status = "<div class='status' style='color: green;'>{$task['status']}</div>";
        } elseif ($task['status'] == "en cours") {
            $status = "<div class='status' style='color: orange;'>{$task['status']}</div>";
        } elseif ($task['status'] == "à faire") {
            $status = "<div class='status' style='color: red;'>{$task['status']}</div>";
        }

        if ($task['priority'] == "basse") {
            $priority = "<div class='priority' style='background-color: green;'>{$task['priority']}</div>";
        } elseif ($task['priority'] == "moyenne") {
            $priority = "<div class='priority' style='background-color: orange;'>{$task['priority']}</div>";
        } elseif ($task['priority'] == "haute") {
            $priority = "<div class='priority' style='background-color: red;'>{$task['priority']}</div>";
        }

        $return .= "<div id='task_{$task['id']}' class='task'>
                        <div class='title'>{$task['title']}</div>
                        $status
                        $priority
                    </div>";
    }

    return $return;
        
}

function infoModal($title, $description, $status, $priority)
{
    
    $return = '';
    $statusmodal = '';
    $prioritymodal = '';



    if ($status == "terminée") {
        $statusmodal = "<div class='statusmodal'><span>Status: </span><span style='color: green;'>{$status}</span></div>";
    } elseif ($status == "en cours") {
        $statusmodal = "<div class='statusmodal'><span>Status: </span><span style='color: orange;'>{$status}</span></div>";
    } elseif ($status == "à faire") {
        $statusmodal = "<div class='statusmodal'><span>Status: </span><span style='color: red;'>{$status}</span></div>";
    }

    if ($priority == "basse") {
        $prioritymodal = "<div class='prioritymodal'><span>Priority: </span><span style='color: white; background-color: green;'>{$priority}</span></div>";
    } elseif ($priority == "moyenne") {
        $prioritymodal = "<div class='prioritymodal'><span>Priority: </span><span style='color: white; background-color: orange;'>{$priority}</span></div>";
    } elseif ($priority == "haute") {
        $prioritymodal = "<div class='prioritymodal'><span>Priority: </span><span style='color: white; background-color: red;'>{$priority}</span></div>";
    }


    $return .= "<i class='close fa-regular fa-circle-xmark'></i>
                <h2>{$title}</h2>
                <div>{$description}</div>
                $statusmodal
                $prioritymodal";


                    
    

    return $return;
        
}