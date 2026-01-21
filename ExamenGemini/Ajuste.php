<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['ultima_accion'])) $_SESSION['ultima_accion']="Ninguna acción registrada";
if (!isset($_SESSION['fecha_accion'])) $_SESSION['fecha_accion']=0;

class Ajuste
{
    // Atributos de instancia
    public $accion;
    public $modulo;
    public $timestamp;

    // Atributos de clase (Estáticos)
    public static $contadorGlobal = 0;
    public static $ultimoModulo = 'N/A';

    public function __construct(string $accion, string $modulo)
    {
        $this->accion = $accion;
        $this->modulo = $modulo;
        $this->timestamp = time();

        $_SESSION['ultima_accion'] = $this->accion . " en " . $this->modulo;;
        $_SESSION['fecha_accion'] = $this->timestamp;

       
    }

    public static function getUltimaAccion()
    {
        return $_SESSION['ultima_accion'];
    }
    public static function getFechaAccion()
    {
        return $_SESSION['fecha_accion'];
    }

    public function getFechaFormato()
    {
        return date('Y-m-d H:i:s', $this->timestamp);
    }
}