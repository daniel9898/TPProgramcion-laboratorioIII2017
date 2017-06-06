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
`logeado` varchar(3) NOT NULL,
FOREIGN KEY (id_cargo) REFERENCES cargos(id_cargo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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