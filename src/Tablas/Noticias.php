<?php

class Noticias
{
    private $id;
    private $titular;
    private $noticia_usuario;

    public function __construct(array $campos)
    {
        $this->id = $campos['id'];
        $this->titular = $campos['titular'];
        $this->noticia_usuario = $campos['noticia_usuario'];
    }
    public function getTitular()
    {
        return $this->titular;
    }

    public function getNoticiaUsuario()
    {
        return $this->noticia_usuario;
    }
}
