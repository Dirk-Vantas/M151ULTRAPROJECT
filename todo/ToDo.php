<?php

//IDK if this is the right implmenetation for the patter but here the view will be executed

//load in all requirements
require('BOToDoManager.php');
require('UIToDoManager.php');

$testCollection = array('item1','item2');

$controlls = new UIRenderToDoManager;
$user = new BOToDoManager;

//debug giving userobject fake ID
$user->setID(500);

//catch input if user made one
$user->catchInput();

//populate user with all his tasks
$user->populate();

//render the control pannel for the user
$controlls->renderControls();

//render all tasks from the user last
$controlls->renderList($user->itemCollection);
