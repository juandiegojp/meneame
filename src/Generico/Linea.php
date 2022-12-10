<?php

namespace App\Generico;

use App\Tablas\Noticias;

class Linea extends Modelo
{
    private Noticias $noticia;
    private int $cantidad;

    public function __construct(Noticias $noticia, int $cantidad = 1)
    {
        $this->setNoticia($noticia);
        $this->setCantidad($cantidad);
    }

    public function getNoticia(): Noticias
    {
        return $this->noticia;
    }

    public function setNoticia(Noticias $noticia)
    {
        $this->noticia = $noticia;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function incrCantidad()
    {
        $this->cantidad++;
    }

    public function decrCantidad()
    {
        $this->cantidad--;
    }
}