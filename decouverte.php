<?php 
session_start();
require_once("app/controller/ControleurPublication.class.php");
$controleurPublication = new ControleurPublication();

$controleurPublication -> gererDecouverte();
