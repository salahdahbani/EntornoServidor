<?php
require_once '../Model/Ticket.php';
$ticketAux = new Ticket("", $_POST['descripcion'], $_POST['estado'], $_POST['id_usuario']);
$ticketAux->insert();
header("Location: ../Controller/index.php");