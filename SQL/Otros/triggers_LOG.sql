-- Voy a asumir MySQL / MariaDB y que lo que necesitas es un registro de auditoría para 
-- saber cuándo se inserta, actualiza o borra un producto (que es el caso más típico en estos ejercicios).
--
CREATE TABLE log_productos (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    accion VARCHAR(10),
    id_producto INT,
    nombreproducto VARCHAR(30),
    precio FLOAT,
    stock INT,
    fecha DATETIME
);


-- Tras insertar un producto

DELIMITER $$

CREATE TRIGGER trg_productos_after_insert
AFTER INSERT ON productos
FOR EACH ROW
BEGIN
    INSERT INTO log_productos (accion, id_producto, nombreproducto, precio, stock, fecha)
    VALUES ('INSERT', NEW.id_producto, NEW.nombreproducto, NEW.precio, NEW.stock, NOW());
END$$

DELIMITER ;

-- Tras actualizar un producto
DELIMITER $$

CREATE TRIGGER trg_productos_after_update
AFTER UPDATE ON productos
FOR EACH ROW
BEGIN
    INSERT INTO log_productos (accion, id_producto, nombreproducto, precio, stock, fecha)
    VALUES ('UPDATE', NEW.id_producto, NEW.nombreproducto, NEW.precio, NEW.stock, NOW());
END$$

DELIMITER ;

-- Tras borrar un producto
DELIMITER $$

CREATE TRIGGER trg_productos_after_delete
AFTER DELETE ON productos
FOR EACH ROW
BEGIN
    INSERT INTO log_productos (accion, id_producto, nombreproducto, precio, stock, fecha)
    VALUES ('DELETE', OLD.id_producto, OLD.nombreproducto, OLD.precio, OLD.stock, NOW());
END$$

DELIMITER ;

-- Al actualizar productos impide que el stock sea negativo
-- También se puede adaptar para el precio
DELIMITER $$

CREATE TRIGGER controlstockactualizar BEFORE UPDATE ON productos FOR EACH ROW
BEGIN
   IF NEW.stock < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error: el stock no puede ser negativo';
   END IF;
END$$

DELIMITER ;

-- Al insertar productos impide que el stock sea negativo
-- También se puede adaptar para el precio
DELIMITER $$

CREATE TRIGGER controlstockinsertar BEFORE INSERT ON productos FOR EACH ROW
BEGIN
   IF NEW.stock < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error: el stock no puede ser negativo';
   END IF;
END$$

DELIMITER ;


-- Cuando cambie la nacionalidad de un proveedor, actualiza el campo pais 
-- de los productos que proporciona (que tengan su CIF).
DELIMITER $$

CREATE TRIGGER trg_actualizar_pais_productos AFTER UPDATE ON proveedores FOR EACH ROW
BEGIN
    -- Solo si cambia la nacionalidad
    IF OLD.nacionalidad <> NEW.nacionalidad THEN
        UPDATE productos SET pais = NEW.nacionalidad WHERE CIF = NEW.CIFprov;
    END IF;
END$$

DELIMITER ;

-- Aplica un 20% de descuento al precio del producto cuando alcanza el stock =5
DELIMITER $$

CREATE TRIGGER trg_descuento_stock_5 BEFORE UPDATE ON productos FOR EACH ROW
BEGIN
    -- Si el stock cambia y llega exactamente a 5, pero solo una vez
    IF NEW.stock = 5 AND OLD.stock <> 5 THEN
        SET NEW.precio = NEW.precio * 0.8;
    END IF;
END$$

DELIMITER ;