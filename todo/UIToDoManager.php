<?php

//Author    : Gideon Watson
//Date      : 10/03/2022

//Here the UI components of the To Do lIst manager will be located, all the controller components will be in the the ToDoManager php file
//I dont really know what to name these files after but I want to make sure I follow the MVC Pattern fully

//I will create a render class that only displays the to do list and its conten from a certain user that is specified 

class UIRenderToDoManager
{
    //Properties
    public $listCollection;
    

    

    //Methods
    function renderList($collection)
    {
        echo '
        <div class="listContainer">
        ';

        foreach($collection as $listItem)
        {   
            

            $id = $listItem['taskID'];

            $CSSmodifier = '';
            $hide = '';

            if($listItem['done'] == 1)
            {
                $CSSmodifier = 'style="text-decoration: line-through;!important;"';
                $hide = 'style="display:none; !important;"';
            }

            $buttons = '
            
            <script src="inc/button.js"></script>
            
            <button onclick="editor('.$id.')" class="btn btn-primary" name="update" value="'.$id.'">Update</button>
            
            <form action="toDo.php" method="post">
            <button class="btn btn-primary" name="delete" value="'.$id.'">delete</button>
            <button class="btn btn-primary" name="done" value="'.$id.'" >done</button>
            </form>
            ';

            //get time and convert it 

            $SQLTimestamp = $listItem['deadline'];
            $seconds = round($SQLTimestamp/1000, 0);
            $PHPDateObject = new DateTime();  
            $PHPDateObject->setTimestamp($seconds);
            $deadline = $PHPDateObject->format('Y-m-d H:i:s');


            //render buttons and the entry
            echo '
            <div id="'.$listItem['taskID'].'" style="border-style:solid;">
            <h1 '.$CSSmodifier.'>'.$listItem['taskTitle'].'</h1><p>Zu erledigen bis : '.$deadline.'</p>'.$buttons.'<br>
            <p '.$CSSmodifier.'>'.$listItem['taskDescription'].'</p>
            </div>
            
            
            ';
            
        
        
        }


        echo '
        </div>
        ';
    }

    function renderControls()
    {
        echo '
        
                <div class="controlPanel">
            <div>
                <form action="" method="post">
                    
                    <label for="itemName">Titel</label><br>
                    <input required type="text" id="itemName" name="titel"><br>
                    
                    <label for="itemDesc">Beschreibung</label><br>
                    <input required type="text" id="itemDesc" name="description"><br>
                    
                    <label for="itemDate">Erledigen bis:</label><br>
                    <input required type="datetime-local" id="itemDate" name="date">
                    
                    <button type="submit" class="btn btn-primary name="SaveItem">Save</button>
                </form>
            </div>
        </div> 
        
        
        
        
        ';
    }

    


}
?>

