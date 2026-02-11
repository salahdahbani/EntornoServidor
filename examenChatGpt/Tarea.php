<?php
// Tarea.php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['ultima_tarea'])) $_SESSION['ultima_tarea']="Ninguna tarea registrada";
if (!isset($_SESSION['fecha_tarea'])) $_SESSION['fecha_tarea']=0;



class Tarea {
private $id; // identificador único dentro del fichero
private $titulo;
private $descripcion;
private $categoria;
private $prioridad;
private $creacion; // timestamp
private $completada; // boolean


    function __construct($id, $titulo, $descripcion, $categoria, $prioridad, $completada = false)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->prioridad = $prioridad;
        $this->completada = $completada;
        $this->creacion = time();
        // Guardar última tarea en sesión (similar a Nota)
        $_SESSION['ultima_tarea'] = $this->titulo;
        $_SESSION['fecha_tarea'] = $this->creacion;
        
    }


    public static function getUltimaTarea(){
        return $_SESSION['ultima_tarea'];
    }
    public static function getFechaTarea(){
        return $_SESSION['fecha_tarea'];    
    }


// Getters
public function getId() { return $this->id; }
public function getTitulo() { return $this->titulo; }
public function getDescripcion() { return $this->descripcion; }
public function getCategoria() { return $this->categoria; }
public function getPrioridad() { return $this->prioridad; }
public function getCreacion() { return $this->creacion; }
public function isCompletada() { return $this->completada; }


// Setters
public function setTitulo($v) { $this->titulo = $v; }
public function setDescripcion($v) { $this->descripcion = $v; }
public function setCategoria($v) { $this->categoria = $v; }
public function setPrioridad($v) { $this->prioridad = $v; }
public function setCompletada($v) { $this->completada = (bool)$v; }



}