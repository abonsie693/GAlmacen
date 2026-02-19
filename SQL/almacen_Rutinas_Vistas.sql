-- Muestra tods los productos del proveedor que se indica
-- PROCEDIMIENTO Productos_del_proveedor
-- Muestra tods los productos del proveedor que se indica
DELIMITER $$
CREATE PROCEDURE Productos_del_proveedor (proveedor CHAR(9))
BEGIN
SELECT nombreproducto, descripcion, pais FROM productos WHERE CIF = proveedor;
END$$
DELIMITER ;
-- CALL Productos_del_proveedor("B34343434")
--------------------------------------------------------------------
-- Muestra todos los productos con stock por debajo del indicado
-- PROCEDIMIENTO Productos_stock
-- Muestra tods los productos con stock por debajo del indicado
DELIMITER $$
CREATE PROCEDURE Productos_stock (cantidad INT)
BEGIN
SELECT nombreproducto, descripcion, stock FROM productos WHERE stock < cantidad;
END$$
DELIMITER ;
-- CALL Productos_stock(10)
--------------------------------------------------------------------
-- FUNCIÓN CUANTOS
-- Devuelve el número de empleados que pertenecen a la empresa desde la fecha dada:
-- --------------------------------------------------------
DELIMITER $$
CREATE FUNCTION cuantos(procedencia varchar(30)) RETURNS int(11)
BEGIN
DECLARE N, numero INT;
select count(*) into numero from productos where (pais = procedencia);
Set N = numero;
RETURN N;
END$$
DELIMITER ;
-- select cuantos("Japón")
-- select cuantos("España") as "PRODUCTOS DE ESPAÑA", cuantos("Japón") as "PRODUCTOS DE JAPÓN", cuantos("China") as "PRODUCTOS DE CHINA";


--------------------------------------------------------------------
-- PROCEDIMIENTO OfertasxPais
-- Devuelve todos los productos de un país con un descuento del x% sobre el predio fijado
-- --------------------------------------------------------
-- OFERTAS POR PAIS, Descuentos del x% en todos los productos del país
DELIMITER $$
CREATE PROCEDURE OfertasxPais (procedencia CHAR(30), dto int)
BEGIN
SELECT nombreproducto as PRODUCTO, precio as "PRECIO", precio-precio*(dto/100) as "OFERTA %", pais as PAIS FROM productos WHERE pais = procedencia;
END$$
DELIMITER ;

-- CALL OfertasxPais("Corea", 10)


--------------------------------------------------------------------
-- FUNCIÓN costepais
-- Devuelve el valor del almacén de un país (suma de todos los productos por el stock)
-- --------------------------------------------------------
DELIMITER $$
CREATE FUNCTION costepais(procedencia varchar(30)) RETURNS int(11)
BEGIN
DECLARE numero INT;
select sum(precio*stock) into numero from productos group by procedencia having pais = procedencia;
RETURN numero;
END$$
DELIMITER ;
-- select sum(precio*stock) from productos group by pais having (pais = "Japón");
-- select costepais("Japón");

--------------------------------------------------------------------
-- FUNCIÓN ALMACENVALOR
-- Devuelve el valor del almacén (suma del precio de todos los productos por el stock)
-- --------------------------------------------------------
DELIMITER $$
CREATE FUNCTION almacenvalor() RETURNS int(11)
BEGIN
DECLARE total INT;
select sum(precio*stock) into total from productos;
RETURN total;
END$$
DELIMITER ;
-- SELECT almacenvalor() as "Coste total del Almacén"



-- select sum(precio*stock) from productos group by pais having (pais = "Japón");
-- select costepais("Japón");
--------------------------------------------------------------------
-- FUNCIÓN valorproductospais
-- Devuelve el valor del almacén de un país (suma de todos los productos por el stock)
-- --------------------------------------------------------
DELIMITER $$
CREATE FUNCTION valoproductospais(procedencia varchar(30)) RETURNS int(11)
BEGIN
DECLARE numero INT;
select sum(precio*stock) into numero from productos group by pais having pais = procedencia;
RETURN numero;
END$$
DELIMITER ;
-- SELECT valorproductospais("Japón") AS "Valor de los productos de Japón";
-- SELECT valorproductospais("Japón") AS "Valor Japón", valorproductospais("China") AS "Valor China", valorproductospais("España") AS "Valor España";
-- select sum(precio*stock) from productos group by pais having pais = "Japón";
-- select PAIS, sum(precio*stock) as VALOR from productos group by pais
-- select valorxpais("Japón");