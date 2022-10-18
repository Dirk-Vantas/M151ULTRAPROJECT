<?php

/**
 * @author Gideon Watson
 * @description Here the UI components of the To Do lIst manager will be located, all the controller components will be in the the ToDoManager php file
 */
class UIRenderToDoManager {
    //Properties
    public $listCollection;

    /**
     * @param $collection
     */
    function renderList($collection) {
        echo '
        <div class="listContainer">
        ';

        foreach ($collection as $listItem) {
            $id = $listItem['taskID'];

            $CSSmodifier = '';
            $hide = '';

            if ($listItem['done'] == 1) {
                $CSSmodifier = 'style="text-decoration: line-through;!important;"';
                $hide = 'style="display:none; !important;"';
            }

            $buttons = '            
            <button onclick="editor(' . $id . ')" class="btn btn-primary update" name="update" value="' . $id . '">Update</button>
            
            <form action="toDo.php" method="post">
            <button class="btn btn-primary finish" name="done" value="' . $id . '" >Erledigt</button>
                        <button class="btn btn-primary delete" name="delete" value="' . $id . '">Löschen</button>
            </form>
            ';

            //get time and convert it
            $SQLTimestamp = $listItem['deadline'];
            $seconds = round($SQLTimestamp / 1000, 0);
            $PHPDateObject = new DateTime();
            $PHPDateObject->setTimestamp($seconds);
            $deadline = $PHPDateObject->format('Y-m-d H:i:s');

            //render buttons and the entry
            echo '
            <div id="' . $listItem['taskID'] . '" class="tasks"><div class="infos">
            <h1 ' . $CSSmodifier . '>' . $listItem['taskTitle'] . '</h1>
             <p ' . $CSSmodifier . '>' . $listItem['taskDescription'] . '</p>
            <p>Zu erledigen bis : ' . $deadline . '</p></div><div class="buttons">' . $buttons . '</div>
          
            </div>
            
            
            ';
        }

        echo '
        </div>
        ';
    }

    function renderControls() {
        echo '
                <div class="controlPanel">
            <div>
                <form action="" method="post">
                   
                   <input required type="text" id="itemName" name="titel" placeholder="Titel">
                   <input required type="text" id="itemDesc" name="description" placeholder="Beschreibung">
                    <input required type="datetime-local" id="itemDate" name="date" placeholder="Erledigen bis">
                   
                    <button type="submit" class="btn btn-primary name="SaveItem">Speichern</button>
                </form>
            </div>
        </div> 

        ';
    }
}


