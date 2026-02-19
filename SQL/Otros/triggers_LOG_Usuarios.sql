-- Para controlar la tabla de usuarios, la vamos a auditar para registrar cada operación y
-- saber cuándo se inserta, actualiza o borra un usuario
--
CREATE TABLE log_usuarios (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    accion VARCHAR(10),
    login VARCHAR(30),
    nomape VARCHAR(50),
    email VARCHAR(50),
    telefono VARCHAR(9),
    fecha DATETIME
);


-- Tras insertar un usuario

DELIMITER $$

CREATE TRIGGER LOG_usuarios_tras_insert
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO log_usuarios (accion, login, nomape, email, telefono, fecha)
    VALUES ('INSERT', NEW.login, NEW.nomape, NEW.email, NEW.telefono, NOW());
END$$

DELIMITER ;

-- Tras actualizar un usuario
DELIMITER $$

CREATE TRIGGER LOG_usuarios_tras_update
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO log_usuarios (accion, login, nomape, email, telefono, fecha)
    VALUES ('UPDATE', NEW.login, NEW.nomape, NEW.email, NEW.telefono, NOW());
END$$

DELIMITER ;

-- Tras borrar un usuario
DELIMITER $$

CREATE TRIGGER LOG_usuarios_tras_delete
AFTER DELETE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO log_usuarios (accion, login, nomape, email, telefono, fecha)
    VALUES ('DELETE', OLD.login, OLD.nomape, OLD.email, OLD.telefono, NOW());
END$$

DELIMITER ;
