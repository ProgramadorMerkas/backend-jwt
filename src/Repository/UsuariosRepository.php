<?php

declare(strict_types=1);

namespace App\Repository;

final class UsuariosRepository
{
    private \PDO $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getDb(): \PDO
    {
        return $this->database;
    }

    public function checkAndGet(int $usuariosId): object
    {
        $query = 'SELECT * FROM `usuarios` WHERE `usuario_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usuariosId);
        $statement->execute();
        $usuarios = $statement->fetchObject();
        if (! $usuarios) {
            throw new \Exception('Usuarios not found.', 404);
        }

        return $usuarios;
    }

    /**find mail user count */
    public function findByMail(string $mail)
    {
        $query = 'SELECT usuario_correo FROM `usuarios` WHERE `usuario_correo` = :mail';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('mail', $mail);
        $statement->execute();
        $usuarios = $statement->fetchObject();
        if (! $usuarios) {
            return false;
        }

        return true;
    }

    public function findByReferido(string $code):object
    {
        $query = "SELECT * FROM `usuarios` WHERE `usuario_codigo` = :code";
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('code', $code);
        $statement->execute();
        $usuarios = $statement->fetchObject();
        if (! $usuarios) {
            
            throw new \Exception('No se encontro usuarios con ese código.', 404);
        }

        return $usuarios;

    }

    //buscar usuarios por codigo

    public function find_by_usuario_codigo(string $codigo):object
    {
        $query = 'SELECT * FROM  `usuarios` WHERE `usuario_codigo` = :codigo LIMIT 0,1';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':codigo', $codigo);
        $statement->execute();

        $usuarios = $statement->fetchObject();
        if (! $usuarios) {
            throw new \Exception('Usuarios not found.', 404);
        }

        return $usuarios;

    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `usuarios` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $usuarios): object
    {
        $query = 'INSERT INTO `usuarios` (`usuario_codigo`, 
        `usuario_id_padre`, 
        `usuario_fecha_registro`, 
        `usuario_rol_principal`, `usuario_nombre_completo`, 
        `usuario_nombre`, `usuario_apellido`, `usuario_genero`, `usuario_tipo_documento`,
         `usuario_numero_documento`, `usuario_correo`, `usuario_telefono`, `usuario_whatssap`,
         `usuario_direccion`, `municipio_id`, `usuario_estado`, `usuario_status`, `usuario_puntos`, 
         `usuario_merkash`, `usuario_contrasena`, `usuario_terminos`, `usuario_ruta_img`, `usuario_token_contrasena`, 
         `usuario_token_fecha`, `usuario_token_merkash`, `usuario_token_merkash_fecha`, `usuario_bienvenida`, 
         `usuario_latitud`, `usuario_longitud`) VALUES ( :usuario_codigo, :usuario_id_padre,
          :usuario_fecha_registro, :usuario_rol_principal, :usuario_nombre_completo, :usuario_nombre, :usuario_apellido,
           :usuario_genero, :usuario_tipo_documento, :usuario_numero_documento, :usuario_correo, :usuario_telefono, 
           :usuario_whatssap, :usuario_direccion, :municipio_id, :usuario_estado, :usuario_status, :usuario_puntos, 
           :usuario_merkash, :usuario_contrasena, :usuario_terminos, :usuario_ruta_img, :usuario_token_contrasena, 
           :usuario_token_fecha, :usuario_token_merkash, :usuario_token_merkash_fecha, :usuario_bienvenida, :usuario_latitud,
            :usuario_longitud)';
        $statement = $this->getDb()->prepare($query); 
        $statement->bindParam('usuario_codigo', $usuarios->usuario_codigo);
        $statement->bindParam('usuario_id_padre', $usuarios->usuario_id_padre);
        $statement->bindParam('usuario_fecha_registro', $usuarios->usuario_fecha_registro);
        $statement->bindParam('usuario_rol_principal', $usuarios->usuario_rol_principal);
        $statement->bindParam('usuario_nombre_completo', $usuarios->usuario_nombre_completo);
        $statement->bindParam('usuario_nombre', $usuarios->usuario_nombre);
        $statement->bindParam('usuario_apellido', $usuarios->usuario_apellido);
        $statement->bindParam('usuario_genero', $usuarios->usuario_genero);
        $statement->bindParam('usuario_tipo_documento', $usuarios->usuario_tipo_documento);
        $statement->bindParam('usuario_numero_documento', $usuarios->usuario_numero_documento);
        $statement->bindParam('usuario_correo', $usuarios->usuario_correo);
        $statement->bindParam('usuario_telefono', $usuarios->usuario_telefono);
        $statement->bindParam('usuario_whatssap', $usuarios->usuario_whatssap);
        $statement->bindParam('usuario_direccion', $usuarios->usuario_direccion);
        $statement->bindParam('municipio_id', $usuarios->municipio_id);
        $statement->bindParam('usuario_estado', $usuarios->usuario_estado);
        $statement->bindParam('usuario_status', $usuarios->usuario_status);
        $statement->bindParam('usuario_puntos', $usuarios->usuario_puntos);
        $statement->bindParam('usuario_merkash', $usuarios->usuario_merkash);
        $statement->bindParam('usuario_contrasena', $usuarios->usuario_contrasena);
        $statement->bindParam('usuario_terminos', $usuarios->usuario_terminos);
        $statement->bindParam('usuario_ruta_img', $usuarios->usuario_ruta_img);
        $statement->bindParam('usuario_token_contrasena', $usuarios->usuario_token_contrasena);
        $statement->bindParam('usuario_token_fecha', $usuarios->usuario_token_fecha);
        $statement->bindParam('usuario_token_merkash', $usuarios->usuario_token_merkash);
        $statement->bindParam('usuario_token_merkash_fecha', $usuarios->usuario_token_merkash_fecha);
        $statement->bindParam('usuario_bienvenida', $usuarios->usuario_bienvenida);
        $statement->bindParam('usuario_latitud', $usuarios->usuario_latitud);
        $statement->bindParam('usuario_longitud', $usuarios->usuario_longitud);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $usuarios ): object
    {
        /*if (isset($data->usuario_id)) {
            $usuarios->usuario_id = $data->usuario_id;
        }
        if (isset($data->usuario_codigo)) {
            $usuarios->usuario_codigo = $data->usuario_codigo;
        }
        if (isset($data->usuario_id_padre)) {
            $usuarios->usuario_id_padre = $data->usuario_id_padre;
        }
        if (isset($data->usuario_fecha_registro)) {
            $usuarios->usuario_fecha_registro = $data->usuario_fecha_registro;
        }
        if (isset($data->usuario_rol_principal)) {
            $usuarios->usuario_rol_principal = $data->usuario_rol_principal;
        }
        if (isset($data->usuario_nombre_completo)) {
            $usuarios->usuario_nombre_completo = $data->usuario_nombre_completo;
        }
        if (isset($data->usuario_nombre)) {
            $usuarios->usuario_nombre = $data->usuario_nombre;
        }
        if (isset($data->usuario_apellido)) {
            $usuarios->usuario_apellido = $data->usuario_apellido;
        }
        if (isset($data->usuario_genero)) {
            $usuarios->usuario_genero = $data->usuario_genero;
        }
        if (isset($data->usuario_tipo_documento)) {
            $usuarios->usuario_tipo_documento = $data->usuario_tipo_documento;
        }
        if (isset($data->usuario_numero_documento)) {
            $usuarios->usuario_numero_documento = $data->usuario_numero_documento;
        }
        if (isset($data->usuario_correo)) {
            $usuarios->usuario_correo = $data->usuario_correo;
        }
        if (isset($data->usuario_telefono)) {
            $usuarios->usuario_telefono = $data->usuario_telefono;
        }
        if (isset($data->usuario_whatssap)) {
            $usuarios->usuario_whatssap = $data->usuario_whatssap;
        }
        if (isset($data->usuario_direccion)) {
            $usuarios->usuario_direccion = $data->usuario_direccion;
        }
        if (isset($data->municipio_id)) {
            $usuarios->municipio_id = $data->municipio_id;
        }
        if (isset($data->usuario_estado)) {
            $usuarios->usuario_estado = $data->usuario_estado;
        }
        if (isset($data->usuario_status)) {
            $usuarios->usuario_status = $data->usuario_status;
        }
        if (isset($data->usuario_puntos)) {
            $usuarios->usuario_puntos = $data->usuario_puntos;
        }
        if (isset($data->usuario_merkash)) {
            $usuarios->usuario_merkash = $data->usuario_merkash;
        }
        if (isset($data->usuario_contrasena)) {
            $usuarios->usuario_contrasena = $data->usuario_contrasena;
        }
        if (isset($data->usuario_terminos)) {
            $usuarios->usuario_terminos = $data->usuario_terminos;
        }
        if (isset($data->usuario_ruta_img)) {
            $usuarios->usuario_ruta_img = $data->usuario_ruta_img;
        }
        if (isset($data->usuario_token_contrasena)) {
            $usuarios->usuario_token_contrasena = $data->usuario_token_contrasena;
        }
        if (isset($data->usuario_token_fecha)) {
            $usuarios->usuario_token_fecha = $data->usuario_token_fecha;
        }
        if (isset($data->usuario_token_merkash)) {
            $usuarios->usuario_token_merkash = $data->usuario_token_merkash;
        }
        if (isset($data->usuario_token_merkash_fecha)) {
            $usuarios->usuario_token_merkash_fecha = $data->usuario_token_merkash_fecha;
        }
        if (isset($data->usuario_bienvenida)) {
            $usuarios->usuario_bienvenida = $data->usuario_bienvenida;
        }
        if (isset($data->usuario_latitud)) {
            $usuarios->usuario_latitud = $data->usuario_latitud;
        }
        if (isset($data->usuario_longitud)) {
            $usuarios->usuario_longitud = $data->usuario_longitud;
        }**/

        $query = 'UPDATE `usuarios` SET  
        `usuario_codigo` = :usuario_codigo, 
        `usuario_id_padre` = :usuario_id_padre, 
        `usuario_fecha_registro` = :usuario_fecha_registro, 
        `usuario_rol_principal` = :usuario_rol_principal, 
        `usuario_nombre_completo` = :usuario_nombre_completo,
         `usuario_nombre` = :usuario_nombre, 
         `usuario_apellido` = :usuario_apellido, 
         `usuario_genero` = :usuario_genero, 
         `usuario_tipo_documento` = :usuario_tipo_documento,
          `usuario_numero_documento` = :usuario_numero_documento,
           `usuario_correo` = :usuario_correo, 
           `usuario_telefono` = :usuario_telefono,
            `usuario_whatssap` = :usuario_whatssap, 
            `usuario_direccion` = :usuario_direccion, 
            `municipio_id` = :municipio_id, 
            `usuario_estado` = :usuario_estado,
             `usuario_status` = :usuario_status,
              `usuario_puntos` = :usuario_puntos, 
              `usuario_merkash` = :usuario_merkash,
               `usuario_contrasena` = :usuario_contrasena, 
               `usuario_terminos` = :usuario_terminos, 
               `usuario_ruta_img` = :usuario_ruta_img,
                `usuario_token_contrasena` = :usuario_token_contrasena,
                 `usuario_token_fecha` = :usuario_token_fecha, 
                 `usuario_token_merkash` = :usuario_token_merkash, 
                 `usuario_token_merkash_fecha` = :usuario_token_merkash_fecha,
                  `usuario_bienvenida` = :usuario_bienvenida,
                   `usuario_latitud` = :usuario_latitud,
                    `usuario_longitud` = :usuario_longitud WHERE `usuario_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usuarios->usuario_id);
        $statement->bindParam('usuario_codigo', $usuarios->usuario_codigo);
        $statement->bindParam('usuario_id_padre', $usuarios->usuario_id_padre);
        $statement->bindParam('usuario_fecha_registro', $usuarios->usuario_fecha_registro);
        $statement->bindParam('usuario_rol_principal', $usuarios->usuario_rol_principal);
        $statement->bindParam('usuario_nombre_completo', $usuarios->usuario_nombre_completo);
        $statement->bindParam('usuario_nombre', $usuarios->usuario_nombre);
        $statement->bindParam('usuario_apellido', $usuarios->usuario_apellido);
        $statement->bindParam('usuario_genero', $usuarios->usuario_genero);
        $statement->bindParam('usuario_tipo_documento', $usuarios->usuario_tipo_documento);
        $statement->bindParam('usuario_numero_documento', $usuarios->usuario_numero_documento);
        $statement->bindParam('usuario_correo', $usuarios->usuario_correo);
        $statement->bindParam('usuario_telefono', $usuarios->usuario_telefono);
        $statement->bindParam('usuario_whatssap', $usuarios->usuario_whatssap);
        $statement->bindParam('usuario_direccion', $usuarios->usuario_direccion);
        $statement->bindParam('municipio_id', $usuarios->municipio_id);
        $statement->bindParam('usuario_estado', $usuarios->usuario_estado);
        $statement->bindParam('usuario_status', $usuarios->usuario_status);
        $statement->bindParam('usuario_puntos', $usuarios->usuario_puntos);
        $statement->bindParam('usuario_merkash', $usuarios->usuario_merkash);
        $statement->bindParam('usuario_contrasena', $usuarios->usuario_contrasena);
        $statement->bindParam('usuario_terminos', $usuarios->usuario_terminos);
        $statement->bindParam('usuario_ruta_img', $usuarios->usuario_ruta_img);
        $statement->bindParam('usuario_token_contrasena', $usuarios->usuario_token_contrasena);
        $statement->bindParam('usuario_token_fecha', $usuarios->usuario_token_fecha);
        $statement->bindParam('usuario_token_merkash', $usuarios->usuario_token_merkash);
        $statement->bindParam('usuario_token_merkash_fecha', $usuarios->usuario_token_merkash_fecha);
        $statement->bindParam('usuario_bienvenida', $usuarios->usuario_bienvenida);
        $statement->bindParam('usuario_latitud', $usuarios->usuario_latitud);
        $statement->bindParam('usuario_longitud', $usuarios->usuario_longitud);

        $statement->execute();

        return $this->checkAndGet((int) $usuarios->usuario_id);
    }

    public function delete(int $usuariosId): void
    {
        $query = 'DELETE FROM `usuarios` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usuariosId);
        $statement->execute();
    }
}
