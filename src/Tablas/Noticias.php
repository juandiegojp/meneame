<?php

namespace App\Tablas;
use PDO;
class Noticias extends Modelo
{
    protected static string $tabla = 'noticias';
    public $id;
    private $titular;
    private $noticia_usuario;

    public function __construct(array $campos)
    {
        $this->id = $campos['id'];
        $this->titular = $campos['titular'];
        $this->noticia_usuario = $campos['noticia_usuario'];
    }

    public static function existe(int $id, ?PDO $pdo = null): bool
    {
        return static::existe($id, $pdo) !== null;
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
