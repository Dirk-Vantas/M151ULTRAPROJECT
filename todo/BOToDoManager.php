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

        $sql = "INSERT INTO tasks (taskTitle, taskDescription, userID,dateCreated,deadline,done) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $placeholderDeadline = time();
        $goal = 0;
        
        $stmt->bind_param("ssiiii", $title, $description, $this->userID,$placeholderDeadline,$placeholderDeadline,$goal);
        $stmt->execute();

        
        //clear post after insertion
        unset($_POST);

    }

    //delete entry made by user
    function delete($ID)
    {
        require('inc/DB.php');

        $sql = "DELETE FROM tasks WHERE taskID=? && userID=?";
        $stmt = $conn->prepare($sql);
        
        //delete only if the right user is making the call
        $stmt->bind_param("ii",$ID,$this->userID);
        $stmt->execute();

        //clear post after insertion
        unset($_POST);

    }

    //update entry made by user
    function update($title, $description,$ID)
    {
        require('inc/DB.php');

        $sql = "UPDATE tasks SET taskTitle=?, taskDescription=? WHERE taskID=? && userID=? ";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("ssii", $title, $description, $ID,$this->userID);
        $stmt->execute();

        //clear post after insertion
        unset($_POST);
    }

    function done($ID)
    {
        require('inc/DB.php');

        $done = 1;

        $sql = "UPDATE tasks SET done=? WHERE taskID=? && userID=? ";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("iii",$done,$ID,$this->userID);
        $stmt->execute();

        //clear post after insertion
        unset($_POST);
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
        
        
        if(isset($_POST['delete']))
        {   
            
            $this->delete($_POST['delete']);
            unset($_POST);
            echo '
            <script>
            window.location = window.location.href;
            </script>
            ';
            
        }

        if(isset($_POST['update']))
        {   
            
            $this->update($_POST['titel'],$_POST['description'],$_POST['update']);
            unset($_POST);
            echo '
            <script>
            window.location = window.location.href;
            </script>
            ';
            
        }

        if(isset($_POST['done']))
        {   
           
            $this->done($_POST['done']);
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