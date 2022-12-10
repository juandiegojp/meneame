<?php

namespace App\Tablas;

use App\Tablas\Noticias;

class Linea extends Modelo
{
    private Noticias $noticia;
    private int $cantidad;

    public function __construct(array $campos)
    {
        $this->noticia = Noticias::obtener($campos['noticias_id']);
        $this->cantidad = $campos['cantidad'];
    }

    public function getArticulo(): Noticias
    {
        return $this->noticia;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }
}