<?php
class Usuario{

    private $idUsuario;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $correo;
    private $rolUsuario;
    private $estado;
    private $pass;

    public function getIdUsuario() {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
        return $this;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
        return $this;
    }
    public function getCorreo()  {
        return $this->correo;
    }
    public function setCorreo($correo) {
        $this->correo = $correo;
        return $this;
    } 
    public function getRolUsuario() {
        return $this->rolUsuario;
    }
    public function setRolUsuario($rolUsuario){
        $this->rolUsuario = $rolUsuario;
        return $this;
    }
    public function getEstado()  {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }
    public function getPass() {
        return $this->pass;
    }
    public function setPass($pass){
        $this->pass = $pass;
        return $this;
    }
}

?>