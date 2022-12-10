<?php
namespace App\Generico;
use PDO;
class Favoritos
{
    public $id_usuarios;
    public $id_noticias;

    public function __construct(array $campos)
    {
        $this->id_usuarios = $campos['id_usuarios'];
        $this->id_noticias = $campos['id_noticias'];
    }

    public static function comprobar(int $id, ?PDO $pdo = null) : bool
    {
        $pdo = $pdo ?? conectar();

        $sent = $pdo->prepare('SELECT *
                                 FROM favoritos
                                WHERE id_noticias = :id');
        $sent->execute([':id' => $id]);
        $fila = $sent->fetch(PDO::FETCH_ASSOC);

        if ($fila === false) {
            return false;
        }
        return true;
    }

    public static function existe(?PDO $pdo = null) : bool
    {
        $pdo = $pdo ?? conectar();

        $sent = $pdo->query('SELECT * FROM favoritos');
        $fila = $sent->fetch(PDO::FETCH_ASSOC);

        if ($fila === false) {
            return false;
        }
        return true;
    }
}
