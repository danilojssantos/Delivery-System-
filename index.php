<?php
    session_start();
    require('deliveryController.php');
    require('deliveryModel.php');
    define('INCLUDE_PATH','http://localhost/Projeto_04/');

    $deliveryController = new deliveryController();
    
    $deliveryController->index();



?>