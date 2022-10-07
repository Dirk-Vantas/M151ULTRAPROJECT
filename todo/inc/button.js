function editor() {

    var taskEditor = '<form action="" method="post">';
    taskEditor += '<label for="itemName">edit Title</label><br>';
    taskEditor += '<input required type="text" id="itemName" name="titel"><br>';
    taskEditor += '<label for="itemDesc">edit Beschreibung</label><br>';
    taskEditor += '<input required type="text" id="itemDesc" name="description">';
    taskEditor += '<button type="submit" class="btn btn-primary name="SaveItem">Save</button>';
    taskEditor += '</form>';
    

    document.getElementById("'.$listItem['taskID'].'").innerHTML = "it worked";
  }
