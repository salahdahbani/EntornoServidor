<?php
require_once '../Model/Usuario.php';
session_start();
session_unset();
session_destroy();
header("Location: ../Controller/login.php");