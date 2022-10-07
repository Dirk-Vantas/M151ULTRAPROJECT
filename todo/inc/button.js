function editor(id) {

    var taskEditor = '<form action="" method="post">';
    taskEditor += '<label for="itemName">edit Title</label><br>';
    taskEditor += '<input required type="text" id="itemName" name="updateTitel"><br>';
    taskEditor += '<label for="itemDesc">edit Beschreibung</label><br>';
    taskEditor += '<input required type="text" id="itemDesc" name="updateDescription">';
    taskEditor += '<button type="submit" class="btn btn-primary" value="'+id+'" name="update">Update</button>';
    taskEditor += '</form>';
    

    document.getElementById(id).innerHTML = taskEditor;
  }
