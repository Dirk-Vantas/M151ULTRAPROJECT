<?php

//IDK if this is the right implmenetation for the patter but here the view will be executed

//load in all requirements
require('BOToDoManager.php');
require('UIToDoManager.php');
require('inc/bootstrap.php');
require('inc/DB.php');


$testCollection = array('item1','item2');

$controlls = new UIRenderToDoManager;
$controlls->renderControls();
$controlls->renderList($testCollection);

?>

