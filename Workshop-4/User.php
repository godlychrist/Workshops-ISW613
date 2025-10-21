<?php

class User {
    private $username;
    private $password;
    private $nombre;
    private $apellidos;
    private $provincia;

    public function __construct($username, $password, $nombre = null, $apellidos = null, $provincia = null) {
        $this->username = $username;
        $this->password = $password; 
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->provincia = $provincia;
    }

    // Métodos Getters
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getProvincia() { return $this->provincia; }
}
?>