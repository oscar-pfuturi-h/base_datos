CREATE DATABASE restaurant;
USE restaurant;

CREATE TABLE sucursal (
	id_sucursal varchar(5) PRIMARY KEY,
	direccion varchar(50) NOT NULL,
	distrito varchar(20) NOT NULL,
    provincia varchar(20) NOT NULL,
    referencia varchar(50),
    hora_abierto time NOT NULL,
    hora_cerrado time NOT NULL,
    mapa varchar(200)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE mesas (
	id_mesa tinyint AUTO_INCREMENT,
	id_sucursal varchar(5) NOT NULL,
	limite tinyint NOT NULL, -- 4
	PRIMARY KEY (id_mesa, id_sucursal),
	CONSTRAINT mesas_fk1 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE productos (
	id_prod tinyint PRIMARY KEY AUTO_INCREMENT,
	nombre varchar(30) UNIQUE NOT NULL,
	disponible bit NOT NULL,-- 0=no, 1=si
	precio numeric(5,2) NOT NULL,
	imagen varchar(200) NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE platillos (
	id_plato tinyint,
	CONSTRAINT platillos_fk1 FOREIGN KEY (id_plato) REFERENCES productos (id_prod)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE postres (
	id_postre tinyint,
	CONSTRAINT postres_fk1 FOREIGN KEY (id_postre) REFERENCES productos (id_prod)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE bebidas (
	id_bebida tinyint,
	alcohol bit NOT NULL,-- 0=sin, 1=con
	CONSTRAINT bebidas_fk1 FOREIGN KEY (id_bebida) REFERENCES productos (id_prod)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE empleados (
	id_empleado integer PRIMARY KEY,-- dni
	id_sucursal varchar(5),
	nombre varchar(30) NOT NULL,
    apellidos varchar(30) NOT NULL,
    telefono integer,
	fecha_nacimiento date,
	salario numeric(6,2) NOT NULL,
	turno varchar(6) NOT NULL,-- mañana, tarde
	CONSTRAINT empleados_fk1 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE camarero (
	id_camarero integer,
	CONSTRAINT camarero_fk1 FOREIGN KEY (id_camarero) REFERENCES empleados (id_empleado)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE cajero (
	id_cajero integer,
	correo varchar(40),
	contrasenha varchar(40),
	CONSTRAINT cajero_fk1 FOREIGN KEY (id_cajero) REFERENCES empleados (id_empleado)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE clientes (
	id_cliente integer PRIMARY KEY AUTO_INCREMENT,
	nombre varchar(30) NOT NULL,
	apellidos varchar(30),
	correo varchar(40) UNIQUE,
	contrasenha varchar(40) UNIQUE
)ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




/*PARTITION BY RANGE(id_cliente)(
	PARTITION p_c1 VALUES less than (11),
  	PARTITION p_c2 VALUES less than (21),
 	PARTITION p_c3 VALUES less than (31),
  	PARTITION p_c4 VALUES less than (41));

CREATE VIEW clientes_p1 AS SELECT * FROM clientes PARTITION (p_c1);
CREATE VIEW clientes_p2 AS SELECT * FROM clientes PARTITION (p_c2);
CREATE VIEW clientes_p3 AS SELECT * FROM clientes PARTITION (p_c3);
CREATE VIEW clientes_p4 AS SELECT * FROM clientes PARTITION (p_c4);*/


CREATE TABLE reservaciones (
	id_reserva integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	nro_clientes tinyint NOT NULL,
	fecha_reservacion date NOT NULL,
    fecha_reservada date NOT NULL,
	hora time NOT NULL,
	id_sucursal varchar(5) NOT NULL,
	CONSTRAINT reserva_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT reserva_fk2 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



/*PARTITION BY RANGE COLUMNS(fecha_reservada)(
	PARTITION p_fecha_r1 VALUES less than ('2020-04-01'),
  	PARTITION p_fecha_r2 VALUES less than ('2020-07-01'),
 	PARTITION p_fecha_r3 VALUES less than ('2020-10-01'),
  	PARTITION p_fecha_r4 VALUES less than ('2021-01-01'));
CREATE VIEW pt1 AS SELECT * FROM tabla1 PARTITION (p1);
CREATE VIEW pt2 AS SELECT * FROM tabla1 PARTITION (p2);*/


CREATE TABLE consumo_cliente (
	id_cliente integer,
	id_prod tinyint,
	cantidad tinyint NOT NULL,
	PRIMARY KEY (id_cliente, id_prod),
	CONSTRAINT consumo_cliente_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
	CONSTRAINT consumo_cliente_fk2 FOREIGN key (id_prod) REFERENCES productos (id_prod)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




/*PARTITION BY RANGE(id_cliente)(
	PARTITION p_cc1 VALUES less than (11),
  	PARTITION p_cc2 VALUES less than (21),
 	PARTITION p_cc3 VALUES less than (31),
  	PARTITION p_cc4 VALUES less than (41));*/

CREATE TABLE facturas (
	id_factura integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	id_empleado integer,
	fecha_emision date NOT NULL,
    hora_emision time NOT NULL,
    pago_total numeric(6,2) NOT NULL,
	CONSTRAINT factura_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT factura_fk2 FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;










/*PARTITION BY RANGE COLUMNS(fecha_emision)(
	PARTITION p_fecha_e1 VALUES less than ('2020-04-01'),
  	PARTITION p_fecha_e2 VALUES less than ('2020-07-01'),
 	PARTITION p_fecha_e3 VALUES less than ('2020-10-01'),
  	PARTITION p_fecha_e4 VALUES less than ('2021-01-01'));*/

CREATE TABLE registro_cliente (
	id_cliente integer,
    id_reserva integer,
    id_factura integer,
    PRIMARY KEY (id_cliente, id_reserva),
	CONSTRAINT registro_cliente_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
    CONSTRAINT registro_cliente_fk2 FOREIGN KEY (id_reserva) REFERENCES reservaciones (id_reserva),
    CONSTRAINT registro_cliente_fk3 FOREIGN KEY (id_factura) REFERENCES facturas (id_factura)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*PARTITION BY RANGE(id_cliente)(
	PARTITION p_rc1 VALUES less than (11),
  	PARTITION p_rc2 VALUES less than (21),
 	PARTITION p_rc3 VALUES less than (31),
  	PARTITION p_rc4 VALUES less than (41));*/



INSERT INTO sucursal VALUES
('L1AQP','Calle Mercaderes 123','Cercado','Arequipa','Plaza de Armas','08:00','21:00','img/mapa1.jpg'),
('L2AQP','Calle Melgar 300','Cercado','Arequipa','Colegio de Abogados','08:00','21:00','img/mapa2.jpg'),
('L3AQP','Av. Pizarro 105','Cercado','Arequipa',null,'08:00','16:00','img/mapa3.jpg'),
('L4AQP','Av. Venezuela 200','Cercado','Arequipa','UNSA - Área de Ingenierías','08:00','16:00','img/mapa4.jpg');

INSERT INTO mesas VALUES
(1,'L1AQP',4),
(2,'L1AQP',4),
(3,'L1AQP',4),
(4,'L1AQP',4),
(5,'L1AQP',4),
(6,'L1AQP',4),
(7,'L1AQP',4),
(8,'L1AQP',4),
(9,'L1AQP',4),
(10,'L1AQP',4),
(11,'L1AQP',4),
(12,'L1AQP',4),
(1,'L2AQP',4),
(2,'L2AQP',4),
(3,'L2AQP',4),
(4,'L2AQP',4),
(5,'L2AQP',4),
(6,'L2AQP',4),
(7,'L2AQP',4),
(8,'L2AQP',4),
(9,'L2AQP',4),
(10,'L2AQP',4),
(11,'L2AQP',4),
(12,'L2AQP',4);

INSERT INTO productos VALUES(1,'Arroz con Pollo',1,8.50,'img/arroz-con-pollo.jpg'),
(2,'Ocopa Arequipeña',0,11.50,'img/ocopa.jpg'),
(3,'Rocoto Relleno',1,12.50,'img/rocoto-relleno.jpg'),
(4,'Helado de Vainilla',0,3.00,'img/helado-vainilla.jpg'),
(5,'Jugo de Frutas',1,1.50,'img/jugo-frutas.jpg'),
(6,'Cóctel de Fresas',1,3.50,'img/coctel-fresas.jpg'),
(7,'Ají de Gallina',1,10.50,'img/aji-gallina.jpg'),
(8, 'Pastel de Chocolate', 1, 4.50, 'img/pastel-chocolate.jpg'),
(9, '400g de Rib Eye', 1, 9.50, 'img/rib-eye.jpg'),
(10, 'Refresco', 1, 1.00, 'img/refresco.jpg'),
(11, 'Café Americano', 1, 3.50, 'img/cafe-americano.jpg'),
(12, 'Tequila', 1, 7.50, 'img/tequila.jpg'),
(13, 'Vodka con Jugo', 0, 5.50, 'img/vodka-jugo.jpg'),
(14, 'Hot Cakes(3)', 1, 3.50, 'img/hot-cakes.jpg'),
(15, 'Omellete', 0, 8.00, 'img/omellete.jpg'),
(16, 'Pastel de Zanahoria', 1, 2.50, 'img/pastel-zanahoria.jpg'),
(17, 'Rol de Canela', 1, 3.50, 'img/rol-canela.jpg'),
(18, 'Jugo de Naranja', 1, 1.50, 'img/jugo-naranga.jpg'),
(19, 'Chuletas de Cerdo', 0, 11.50, 'img/chuletas-cerdo.jpg'),
(20, 'Costillas BBQ', 1, 15.00, 'img/costillas-bbq.jpg'),
(21, 'Jugo de Zanahoria', 1, 1.50, 'img/jugo-zanahoria.jpg'),
(22, 'Jugo de Toronja', 0, 7.50, 'img/jugo-toronja.jpg'),
(23, 'Filete de Pescado Róbalo', 1, 12.50, 'img/filete-robalo.jpg'),
(24, 'Filete de Atún ', 1, 11.50, 'img/filete-atun.jpg'),
(25, 'Milanesa de Pollo', 1, 8.50, 'img/milanesa-pollo.jpg'),
(26, 'Pierna de Ternera al Horno', 1, 12.50, 'img/pierna-ternera.jpg'),
(27, 'Café Capuchino', 1, 4.50, 'img/cafe-capuchino.jpg'),
(28, 'Café Latte', 0, 3.50, 'img/cafe-latte.jpg'),
(29, 'Café Expresso', 1, 3.50, 'img/cafe-expresso.jpg'),
(30, 'Vino Tinto Francia', 1, 19.50, 'img/vino-francia.jpg'),
(31, 'Vino Tinto México', 1, 13.00, 'img/vino-mexico.jpg'),
(32, 'Vino Tinto España', 1, 17.50, 'img/vino-espana.jpg'),
(33, 'Pastel de Manzana', 1, 2.50, 'img/pastel-manzana.jpg');

INSERT INTO platillos VALUES
(1), (2), (3), (7), (9), (15), (19), (20), (23), (24), (25), (26);
INSERT INTO postres VALUES
(4), (8), (14), (16), (17), (33);
INSERT INTO bebidas VALUES
(5, 0), (6, 1), (10, 0), (11, 0), (12, 1), (13, 1), (18, 0), (21, 0), (22, 0),
(27, 0), (28, 0), (29, 0), (30, 1), (31, 1), (32, 1);

INSERT INTO empleados VALUES 
(75887766,'L1AQP','Carlos','Mamani Quispe', 999888777, '1995-05-16',950.00,'mañana'),
(71154511,'L1AQP','Armando','Quispe Mamani', 999777666, '1999-02-11',950.00,'tarde'),
(45159912,'L1AQP','Alex','Condori Checa', 999888778, '1991-09-16',1150.00,'mañana'),
(65421913,'L2AQP','Maria','Valencia Castro', 999888773, '2000-05-01',950.00,'mañana'),
(79544914,'L2AQP','Robert','Huarca Castillo', 999888757, '1995-08-19',1150.00,'mañana'),
(74222915,'L1AQP', 'Miriam', 'Ibañez', 999888717, '2001-07-01', 1150.00,'mañana'),
(65412916,'L2AQP', 'Samuel ', 'Reyes', 999888727, '1999-07-02', 950.00,'mañana'),
(70099919,'L1AQP', 'Carmen', 'Ruiz', 999444777, '1995-07-01', 950.00,'mañana'),
(70199920,'L1AQP', 'Isaac', 'Salas', 999222777, '1990-07-30', 1150.00,'mañana'),
(70399921,'L1AQP', 'Ana', 'Preciado', 999111777, '2000-06-28', 1150.00,'tarde'),
(70421565,'L1AQP', 'Sergio', 'Iglesias', 999333777, '2000-07-02', 950.00,'mañana'),
(78451212,'L2AQP', 'Carlos', 'Ortiz', 999555777, '1991-06-25', 950.00,'tarde'),
(79555422,'L1AQP', 'Roberto', 'Serrano', 999666777, '1993-07-30', 950.00,'mañana');

INSERT INTO camarero VALUES
(75887766), (71154511), (65421913), (65412916), (70099919), 
(70421565), (78451212), (79555422);
INSERT INTO cajero VALUES
(45159912,'alecc@gmail.com','pass1'),
(79544914,'robhc@gmail.com','pass2'),
(74222915,'mirib@gmail.com','pass3'),
(70199920,'isaas@gmail.com','pass4'),
(70399921,'anapr@gmail.com','pass5');

INSERT INTO clientes VALUES 
(101,'Kevin', 'Mamani Condori','kevmc@gmail.com','contra1'),
(102,'Wilmer', 'Lopez Zegarra','willz@gmail.com','contra2'),
(103,'Edwin', 'Choque Quispe','edwcq@gmail.com','contra3'),
(104,'Diana', 'Medina Acosta','diama@gmail.com','contra4'),
(105, 'Juan', 'De la torre', 'juadt@gmail.com','contra5'),
(106, 'Antonio', 'Hernandez', 'anthe@gmail.com','contra6'),
(107, 'Pedro', 'Juarez', 'pedju@gmail.com','contra7'),
(108, 'Mireya', 'Perez', 'mirpe@gmail.com','contra8'),
(109, 'Jose', 'Castillo','josca@gmail.com','contra9'),
(110, 'Maria', 'Diaz', 'mardi@gmail.com','contra10'),
(111, 'Clara', 'Duran', 'cladu@gmail.com','contra11'),
(112, 'Joaquin', 'Muñoz', 'joamu@gmail', 'contra12'),
(113, 'Julia', 'Lopez', 'jullo@gmail.com','contra13'),
(114, 'Aina', 'Acosta','ainac@gmail.com','contra14'),
(115, 'Carlota', 'Perez', 'carpe@gmail.com','contra15'),
(116, 'Ana Maria', 'Igleias', 'anaig@gmail.com','contra16'),
(117, 'Jaime', 'Jimenez', 'jaiji@gmail.com','contra17'),
(118, 'Roberto ', 'Torres', 'robto@gmail.com','contra18'),
(119, 'Juan', 'Cano', 'juaca@gmail.com','contra19'),
(120, 'Santiago', 'Hernandez', 'sanhe@gmail.com','contra20'),
(121, 'Berta', 'Gomez', 'bertg@gmail.com','contra21'),
(122, 'Miriam', 'Dominguez', 'mirdo@gmail.com','contra22'),
(123, 'Antonio', 'Castro', 'antca@gmail.com','contra23'),
(124, 'Hugo', 'Alonso', 'hugal@gmail.com','contra24'),
(125, 'Victoria', 'Perez', 'vicpe@gmail.com','contra25'),
(126, 'Jimena', 'Leon', 'jimle@gmail.com','contra26'),
(127, 'Raquel ', 'Peña','raqpe@gmail.com','contra27');

INSERT INTO reservaciones VALUES (1,101,5,'2020-07-12','2020-07-13','16:15','L1AQP'),
(2,102,3,'2020-07-13','2020-07-15','10:30','L1AQP'),
(3,104,2,'2020-07-10','2020-07-19','18:00','L1AQP');

INSERT INTO consumo_cliente VALUES 
(101,1,5),
(101,5,5),
(102,3,3),
(102,4,3),
(102,5,3),
(104,3,2),
(104,6,2);

INSERT INTO facturas VALUES (1,101,null,'2020-07-12','12:12:03',50.00),
(2,102,null,'2020-07-13','15:17:13',51.00),
(3,104,null,'2020-07-10','08:12:53',32.00);

INSERT INTO registro_cliente VALUES(101,1,1),
(102,2,2),
(104,3,3);


/*ALTER TABLE reservaciones PARTITION BY RANGE(fecha_reservada)(
    PARTITION P1 ( fecha_reservada between 01-01-2020 to 31-03-2020),
    PARTITION P2 ( fecha_reservada between 01-04-2020 to 30-06-2020),
    PARTITION P3 ( fecha_reservada between 01-07-2020 to 30-09-2020),
    PARTITION P4 ( fecha_reservada between 01-10-2020 to 31-12-2020),
);*/




CREATE TABLE reservaciones_01_04(
	id_reserva integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	nro_clientes tinyint NOT NULL,
	fecha_reservacion date NOT NULL,
    fecha_reservada date NOT NULL,
	hora time NOT NULL,
	id_sucursal varchar(5) NOT NULL,
	CONSTRAINT reserva1_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT reserva1_fk2 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE reservaciones_05_08(
	id_reserva integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	nro_clientes tinyint NOT NULL,
	fecha_reservacion date NOT NULL,
    fecha_reservada date NOT NULL,
	hora time NOT NULL,
	id_sucursal varchar(5) NOT NULL,
	CONSTRAINT reserva2_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT reserva2_fk2 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE reservaciones_09_12(
	id_reserva integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	nro_clientes tinyint NOT NULL,
	fecha_reservacion date NOT NULL,
    fecha_reservada date NOT NULL,
	hora time NOT NULL,
	id_sucursal varchar(5) NOT NULL,
	CONSTRAINT reserva3_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT reserva3_fk2 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE facturas_01_04(
	id_factura integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	id_empleado integer,
	fecha_emision date NOT NULL,
    hora_emision time NOT NULL,
    pago_total numeric(6,2) NOT NULL,
	CONSTRAINT factura1_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT factura1_fk2 FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE facturas_05_08(
	id_factura integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	id_empleado integer,
	fecha_emision date NOT NULL,
    hora_emision time NOT NULL,
    pago_total numeric(6,2) NOT NULL,
	CONSTRAINT factura2_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT factura2_fk2 FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE facturas_09_12(
	id_factura integer PRIMARY KEY AUTO_INCREMENT,
	id_cliente integer,
	id_empleado integer,
	fecha_emision date NOT NULL,
    hora_emision time NOT NULL,
    pago_total numeric(6,2) NOT NULL,
	CONSTRAINT factura3_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT factura3_fk2 FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE consumo_cliente_01_04(
	id_cliente integer,
	id_prod tinyint,
	cantidad tinyint NOT NULL,
	PRIMARY KEY (id_cliente, id_prod),
	CONSTRAINT consumo1_cliente_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
	CONSTRAINT consumo1_cliente_fk2 FOREIGN key (id_prod) REFERENCES productos (id_prod)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE consumo_cliente_05_08 (
	id_cliente integer,
	id_prod tinyint,
	cantidad tinyint NOT NULL,
	PRIMARY KEY (id_cliente, id_prod),
	CONSTRAINT consumo2_cliente_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
	CONSTRAINT consumo2_cliente_fk2 FOREIGN key (id_prod) REFERENCES productos (id_prod)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE consumo_cliente_09_12 (
	id_cliente integer,
	id_prod tinyint,
	cantidad tinyint NOT NULL,
	PRIMARY KEY (id_cliente, id_prod),
	CONSTRAINT consumo3_cliente_fk1 FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
	CONSTRAINT consumo3_cliente_fk2 FOREIGN key (id_prod) REFERENCES productos (id_prod)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DELIMITER //
CREATE PROCEDURE insertar_sucursal(IN id_reserva integer,IN id_cliente integer,IN nro_clientes tinyint,
						IN fecha_reservacion date,IN fecha_reservada date,IN hora time,IN id_sucursal varchar(5))
BEGIN
    IF MONTH(fecha_reservacion)<=4 THEN
    	INSERT INTO reservaciones_01_04 VALUES (id_reserva,id_cliente,nro_clientes,fecha_reservacion,fecha_reservada,hora,id_sucursal);
    ELSE IF MONTH(fecha_reservacion)>4 and MONTH(fecha_reservacion)<=8 THEN
    	INSERT INTO reservaciones_05_08 VALUES (id_reserva,id_cliente,nro_clientes,fecha_reservacion,fecha_reservada,hora,id_sucursal);
    ELSE
    	INSERT INTO reservaciones_09_12 VALUES (id_reserva,id_cliente,nro_clientes,fecha_reservacion,fecha_reservada,hora,id_sucursal);
    END IF;
    END IF;
END //

DELIMITER //
CREATE PROCEDURE insertar_facturas(IN id_factura integer, IN id_cliente integer,IN id_empleado integer,IN fecha_emision date,IN hora_emision time,IN pago_total numeric(6,2))
BEGIN
    IF MONTH(fecha_emision)<=4 THEN
    	INSERT INTO facturas_01_04 VALUES (id_factura,id_cliente,id_empleado,fecha_emision,hora_emision,pago_total);
    ELSE IF MONTH(fecha_emision)>4 and MONTH(fecha_emision)<=8 THEN
    	INSERT INTO facturas_05_08 VALUES (id_factura,id_cliente,id_empleado,fecha_emision,hora_emision,pago_total);
    ELSE
    	INSERT INTO facturas_09_12 VALUES (id_factura,id_cliente,id_empleado,fecha_emision,hora_emision,pago_total);
    END IF;
    END IF;
END //

