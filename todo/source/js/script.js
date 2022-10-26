function editor(id) {

    var taskEditor = '<form action="" method="post">';
    taskEditor += '<label for="itemName">Titel</label><br>';
    taskEditor += '<input  type="text" id="itemName" name="updateTitel" required><br>';

    taskEditor += '<label for="itemDesc">Beschreibung</label><br>';
    taskEditor += '<input  type="text" id="itemName" name="updateDescription" required><br>';

    taskEditor += '<label for="itemDesc">Datum</label><br>';
    taskEditor += '<input  type="date" id="itemDesc" name="updateDate" required>';

    taskEditor += '<button type="submit" class="btn btn-primary" value="'+id+'" name="update" >Update</button>';
    taskEditor += '</form>';

    document.getElementById(id).innerHTML = taskEditor;
  }
