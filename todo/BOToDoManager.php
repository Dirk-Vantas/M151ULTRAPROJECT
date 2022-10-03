<?php



//Author    : Gideon Watson
//Date      : 10/03/2022

//Here all the logic components should be put like sending the requests to the model wich then send out the actual SQL requestst to the DB

class BOToDoManager
{
    //Properties
    public $itemCollection;
    private $userID;
    

    //Methods

    //pupulate the collection with all saved items from the DB
    function populate()
    {
        //get DB
        require('inc/DB.php');
        
        //get all saved items from the DB for that user
        $result = $conn->query('SELECT * FROM tasks WHERE userID='.$this->userID);

        //if entries are found add them to the object
        if(!empty($result))
        {   
            //adding collection into property
            $this->itemCollection = $result;
        }
        
    }

    //set the ID of the active user, this will only be handled inside the class
    function setID($ID)
    {
        $this->userID = $ID;
    }

    //save entry made by user
    function save($title, $description)
    {   
        require('inc/DB.php');

        $sql = "INSERT INTO tasks (taskTitle, taskDescription, userID) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("ssi", $title, $description, $this->userID);
        $stmt->execute();

        //clear post after insertion
        unset($_POST);

    }

    //delete entry made by user
    function delete()
    {

    }

    //update entry made by user
    function update()
    {

    }

    //function that looks for user input into the form
    //if it finds an input it will save it
    function catchInput()
    {
        if(isset($_POST['titel']) && isset($_POST['description']))
        {   
            
            $this->save($_POST['titel'],$_POST['description']);
            unset($_POST);
            echo '
            <script>
            window.location = window.location.href;
            </script>
            ';
            
        }
    }



}


?>