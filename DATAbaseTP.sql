CREATE TABLE `clientes` (
`id_cliente` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY,
`dni` int(20) COLLATE utf8_spanish2_ci NOT NULL,
`nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
`apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `automovil` (
`id_automovil` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY ,
`patente` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
`color` varchar(12) COLLATE utf8_spanish2_ci,
`marca` varchar(12) COLLATE utf8_spanish2_ci,
`id_cliente` int(11) NOT NULL,
FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `lugares` (
`id_lugar` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY,
`disponibilidad` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,/*ocupado-vacio*/
`discapacitados` varchar(4) COLLATE utf8_spanish2_ci NOT NULL /*si-no*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `lugares` (`id_lugar`,`disponibilidad`,`discapacitados`) VALUES
(1, 'vacio', 'si'),
(2, 'vacio', 'si'),
(3, 'vacio', 'si'),  
(4, 'vacio', 'no'),
(5, 'vacio', 'no'),
(6, 'vacio', 'no'),
(7, 'vacio', 'no'),
(8, 'vacio', 'no'),
(9, 'vacio', 'no'),
(10,'vacio', 'no');

CREATE TABLE `cargos` (
`id_cargo` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY,
`cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `cargos` (`id_cargo`,`cargo`) VALUES
(1, 'administrador'),
(2, 'cajero');

CREATE TABLE `empleados` (
`id_empleado` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY,
`nombre` varchar(20)  COLLATE utf8_spanish2_ci NOT NULL,
`apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
`usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
`contraseña` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
`id_cargo` int(11) NOT NULL,
`Esta_logeado` varchar(3) NOT NULL,
FOREIGN KEY (id_cargo) REFERENCES cargos(id_cargo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `empleados` (`nombre`,`apellido`,`usuario`,`contraseña`,`id_cargo`,`Esta_logeado`) VALUES
('ruben','paz','cajero1','cj1',2,'no'),
('marco','ruben','cajero2','cj2',2,'no'),
('daniel','paz','admin','adm',1,'no');

CREATE TABLE `operaciones` (
`id_operacion` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY AUTO_INCREMENT,
`id_cliente` int(11) NOT NULL,
`id_automovil` int(11) NOT NULL,
`id_lugar` int(11) NOT NULL,
`id_empleadoEntrada` int(11) NOT NULL,
`id_empleadoSalida` int(11),
FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
FOREIGN KEY (id_automovil) REFERENCES automovil(id_automovil),
FOREIGN KEY (id_lugar) REFERENCES lugares(id_lugar),
FOREIGN KEY (id_empleadoEntrada) REFERENCES empleados(id_empleado),
FOREIGN KEY (id_empleadoSalida) REFERENCES empleados(id_empleado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `registro_final` (
`id_registro` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
`id_cliente` int(11) NOT NULL,
`id_operacion` int(11) NOT NULL,
`hora_entrada` varchar(11) NOT NULL,
`hora_salida` varchar(11),
`importe` int(11),
FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
FOREIGN KEY (id_operacion) REFERENCES operaciones(id_operacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `logins` (
`id_login` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
`id_empleado` int(11) NOT NULL,
`fecha_apertura` varchar(11) NOT NULL,
`fecha_cierre` varchar(11),
FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `logins` (`id_empleado`,`fecha_apertura`,`fecha_cierre`) VALUES
(1,'2017-07-04 12:28:27','2017-07-04 18:28:27'),
(3,'2017-07-04 19:28:27','2017-07-04 22:28:27'),
(1,'2017-07-03 11:28:27','2017-07-03 14:28:27'),
(2,'2017-08-01 13:28:27','2017-08-01 15:28:27');