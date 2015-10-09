<?php

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");

Plugin::load('processmaker',true);

if (!isset($_REQUEST["id"])) {
    $_REQUEST["id"] = "";
}

$PluginProcess = new PluginProcessmakerProcess();

if (isset($_REQUEST["update"])) {
    $PluginProcess->check($_REQUEST['id'], 'w');
    $PluginProcess->update($_REQUEST);
    Html::back();

} elseif (isset($_REQUEST["refreshtask"])) {
    $PluginProcess->check($_REQUEST['id'], 'w');
    $PluginProcess->refreshTasks($_REQUEST);
    Html::back();
    
} else {
    $PluginProcess->checkGlobal('r');
    
    Html::header($LANG['processmaker']['title'][1],$_SERVER["PHP_SELF"],"plugins","processmaker");
    
    $PluginProcess->showForm($_REQUEST["id"]);

    Html::footer();
}
?>