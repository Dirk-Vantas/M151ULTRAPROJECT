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
        foreach($collection as $listItem)
        {
            echo 'List Item';
        }
    }

    


}
?>