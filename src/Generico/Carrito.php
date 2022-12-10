<?php

namespace App\Generico;

use App\Tablas\Noticias;
use ValueError;

class Carrito extends Modelo
{
    private array $lineas;

    public function __construct()
    {
        $this->lineas = [];
    }

    public function insertar($id)
    {
        if (!($noticia = Noticias::obtener($id))) {
            throw new ValueError('La noticia no existe.');
        }

        if (isset($this->lineas[$id])) {
            $this->lineas[$id]->incrCantidad();
        } else {
            $this->lineas[$id] = new Linea($noticia);
        }
    }

    public function eliminar($id)
    {
        if (isset($this->lineas[$id])) {
            $this->lineas[$id]->decrCantidad();
            if ($this->lineas[$id]->getCantidad() == 0) {
                unset($this->lineas[$id]);
            }
        } else {
            throw new ValueError('Noticia inexistente en el carrito');
        }
    }

    public function vacio(): bool
    {
        return empty($this->lineas);
    }

    public function getLineas(): array
    {
        return $this->lineas;
    }

    public function getTotalItems(): int
    {
        $total = 0;
        if($this->vacio()) {
            return $total;
        }
        foreach ($this->getLineas() as $id => $linea) {
            $total += $linea->getCantidad();
        }
        return $total;
    }
}