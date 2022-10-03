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
            echo '<div style="border-style:solid;">';
            
            echo '<div style="border-bottom-style: solid; border-width:1px;">'.$listItem['taskTitle'].'</div>';
            echo '<div>'.$listItem['taskDescription'].'</div>';
            
            echo '</div>';
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
        <form action="toDo.php" method="post">
            <label for="itemName">Titel</label><br>
            <input required type="text" id="itemName" name="titel"><br>
            <label for="itemDesc">Beschreibung</label><br>
            <input required type="text" id="itemDesc" name="description">
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div> 
        
        
        
        
        ';
    }

    


}
?>

