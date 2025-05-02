-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2025 a las 22:07:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `edufast`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `nombre_act` char(100) DEFAULT NULL,
  `descripcion` varchar(1300) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `docente_has_materia_docente_id_docente` int(11) NOT NULL,
  `docente_has_materia_materia_id_materia` int(11) NOT NULL,
  `logro_grado_id_grado` int(11) NOT NULL,
  `logro_id_logro` int(11) NOT NULL,
  `logro_materia_id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `nombre_act`, `descripcion`, `fecha_entrega`, `docente_has_materia_docente_id_docente`, `docente_has_materia_materia_id_materia`, `logro_grado_id_grado`, `logro_id_logro`, `logro_materia_id_materia`) VALUES
(1, 'Mi presentación en inglés', '1. Los estudiantes escribirán una presentación corta con frases como:\r\n\r\n\"Hello, my name is ____.\"\r\n\r\n\"I am ____ years old.\"\r\n\r\n\"I like ____.\"\r\n\r\n2. Luego, harán una presentación oral frente a la clase.', '2025-04-22', 1, 8, 6, 1002, 8),
(2, 'Mi familia en inglés', '1. Los estudiantes escribirán una breve descripción de los miembros de su familia utilizando frases como:\r\n\r\n\"My father is ____.\"\r\n\r\n\"My mother is ____.\"\r\n\r\n\"I have ____ brothers and ____ sisters.\"\r\n\r\n2. Después, presentarán su descripción oralmente en clase.', '2025-04-25', 1, 8, 6, 1002, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nombre_area` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `nombre_area`) VALUES
(1, 'Lógico creativo'),
(2, 'Ambiente artístico'),
(3, 'Ambiente integral'),
(4, 'Ambiente ético social'),
(5, 'Ambiente técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL,
  `fecha_asistencia` date DEFAULT NULL,
  `asistencia` char(10) DEFAULT NULL,
  `matricula_id_matricula` int(11) NOT NULL,
  `matricula_grado_id_grado` int(11) NOT NULL,
  `matricula_cursos_id_cursos` int(11) NOT NULL,
  `matricula_estudiante_id_estudiante` int(11) NOT NULL,
  `matricula_estudiante_registro_num_doc` int(11) NOT NULL,
  `matricula_estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `matricula_estudiante_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idAsistencia`, `fecha_asistencia`, `asistencia`, `matricula_id_matricula`, `matricula_grado_id_grado`, `matricula_cursos_id_cursos`, `matricula_estudiante_id_estudiante`, `matricula_estudiante_registro_num_doc`, `matricula_estudiante_registro_rol_id_rol`, `matricula_estudiante_registro_jornada_id_jornada`) VALUES
(1, '2025-04-21', 'Presente', 3, 6, 7, 2, 1012366209, 6, 2),
(2, '2025-04-08', 'Ausente', 3, 6, 7, 2, 1012366209, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletin`
--

CREATE TABLE `boletin` (
  `id_boletin` int(11) NOT NULL,
  `periodo` char(10) DEFAULT NULL,
  `puesto` char(10) DEFAULT NULL,
  `fechaBoletin` date DEFAULT NULL,
  `añoBoletin` char(10) DEFAULT NULL,
  `Observacion_idObservacion` int(11) NOT NULL,
  `nota_id_nota` int(11) NOT NULL,
  `nota_matricula_id_matricula` int(11) NOT NULL,
  `nota_actividad_id_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_cursos` int(11) NOT NULL,
  `curso` char(10) DEFAULT NULL,
  `grado_id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_cursos`, `curso`, `grado_id_grado`) VALUES
(1, '01', 1),
(3, '102', 2),
(4, '201', 3),
(5, '301', 4),
(6, '401', 5),
(7, '501', 6),
(8, '601', 7),
(9, '701', 8),
(10, '801', 9),
(11, '901', 10),
(12, '1001', 11),
(13, '1101', 12),
(14, '1102', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `profesion` char(45) DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL,
  `registro_rol_id_rol` int(11) NOT NULL,
  `registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `profesion`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) VALUES
(1, 'Licenciado en ingles', 52762656, 5, 1),
(2, 'Licenciado en español', 1012345678, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_has_cursos`
--

CREATE TABLE `docente_has_cursos` (
  `docente_id_docente` int(11) NOT NULL,
  `docente_registro_num_doc` int(11) NOT NULL,
  `docente_registro_rol_id_rol` int(11) NOT NULL,
  `docente_registro_jornada_id_jornada` int(11) NOT NULL,
  `cursos_id_cursos` int(11) NOT NULL,
  `cursos_grado_id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente_has_cursos`
--

INSERT INTO `docente_has_cursos` (`docente_id_docente`, `docente_registro_num_doc`, `docente_registro_rol_id_rol`, `docente_registro_jornada_id_jornada`, `cursos_id_cursos`, `cursos_grado_id_grado`) VALUES
(1, 52762656, 5, 1, 1, 1),
(2, 1012345678, 5, 2, 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_has_materia`
--

CREATE TABLE `docente_has_materia` (
  `docente_id_docente` int(11) NOT NULL,
  `materia_id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente_has_materia`
--

INSERT INTO `docente_has_materia` (`docente_id_docente`, `materia_id_materia`) VALUES
(1, 8),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int(11) NOT NULL,
  `sexo` char(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `Eps` varchar(45) DEFAULT NULL,
  `RH` char(10) DEFAULT NULL,
  `NIvel_educativo` char(45) DEFAULT NULL,
  `grado_cursado` char(15) NOT NULL,
  `Estado` char(25) DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL,
  `registro_rol_id_rol` int(11) NOT NULL,
  `registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id_estudiante`, `sexo`, `fecha_nacimiento`, `Eps`, `RH`, `NIvel_educativo`, `grado_cursado`, `Estado`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) VALUES
(2, 'F', '2008-01-03', 'Famisanar', 'O+', 'Primaria', '2º', 'Nuevo', 1012366209, 6, 2),
(4, 'M', '2009-09-23', 'Sanitas', 'O+', 'Secundaria', '1°', 'Nuevo', 93481465, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `nivel_educativo` char(45) DEFAULT NULL,
  `grado` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `nivel_educativo`, `grado`) VALUES
(1, 'Primaria', '0°'),
(2, 'Primaria', '1°'),
(3, 'Primaria', '2°'),
(4, 'Primaria', '3°'),
(5, 'Primaria', '4°'),
(6, 'Primaria', '5°'),
(7, 'Bachillerato', '6°'),
(8, 'Bachillerato', '7°'),
(9, 'Bachillerato', '8°'),
(10, 'Bachillerato', '9°'),
(11, 'Bachillerato', '10°'),
(12, 'Bachillerato', '11°'),
(14, 'Bachilletato', '12°');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `id_jornada` int(11) NOT NULL,
  `jornada` char(20) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id_jornada`, `jornada`, `hora_inicio`, `hora_final`) VALUES
(1, 'Sin jornada', NULL, NULL),
(2, 'Mañana', '06:00:00', '11:50:00'),
(3, 'Tarde', '12:00:00', '17:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logro`
--

CREATE TABLE `logro` (
  `id_logro` int(11) NOT NULL,
  `nombre_logro` char(100) DEFAULT NULL,
  `descripcion_logro` char(200) DEFAULT NULL,
  `grado_id_grado` int(11) NOT NULL,
  `materia_id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logro`
--

INSERT INTO `logro` (`id_logro`, `nombre_logro`, `descripcion_logro`, `grado_id_grado`, `materia_id_materia`) VALUES
(1001, 'Explorador Musical del Ritmo', ' El estudiante reconoce y reproduce patrones rítmicos básicos mediante el uso de instrumentos de percusión y su propia voz, demostrando coordinación y creatividad en la interpretación musical.', 6, 6),
(1002, 'Mejorando mi comprensión del inglés', 'Al finalizar el primer grado de inglés, los estudiantes serán capaces de reconocer y utilizar frases sencillas en inglés relacionadas con su entorno diario. Serán capaces de identificar al menos 20 pa', 6, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `materia` char(45) DEFAULT NULL,
  `area_id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `materia`, `area_id_area`) VALUES
(1, 'Matematicas', 1),
(2, 'Español', 2),
(3, 'Biología', 3),
(4, 'Ética y religión', 4),
(5, 'Sistemas', 5),
(6, 'Artes', 2),
(8, 'Ingles', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id_matricula` int(11) NOT NULL,
  `grado_id_grado` int(11) NOT NULL,
  `cursos_id_cursos` int(11) NOT NULL,
  `estudiante_id_estudiante` int(11) NOT NULL,
  `estudiante_registro_num_doc` int(11) NOT NULL,
  `estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `estudiante_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id_matricula`, `grado_id_grado`, `cursos_id_cursos`, `estudiante_id_estudiante`, `estudiante_registro_num_doc`, `estudiante_registro_rol_id_rol`, `estudiante_registro_jornada_id_jornada`) VALUES
(3, 6, 7, 2, 1012366209, 6, 2),
(4, 6, 7, 4, 93481465, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `fecha_nota` date DEFAULT NULL,
  `nota` decimal(10,0) DEFAULT NULL,
  `matricula_id_matricula` int(11) NOT NULL,
  `actividad_id_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id_nota`, `fecha_nota`, `nota`, `matricula_id_matricula`, `actividad_id_actividad`) VALUES
(1, '2025-04-15', 5, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE `observacion` (
  `idObservacion` int(11) NOT NULL,
  `fechaCompromiso` date DEFAULT NULL,
  `observacion` char(120) DEFAULT NULL,
  `compromiso` char(120) DEFAULT NULL,
  `nombre_docente` char(45) DEFAULT NULL,
  `firma_alumno` longblob DEFAULT NULL,
  `observador_id_observador` int(11) NOT NULL,
  `estudiante_id_estudiante` int(11) NOT NULL,
  `estudiante_registro_num_doc` int(11) NOT NULL,
  `estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `estudiante_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observacion`
--

INSERT INTO `observacion` (`idObservacion`, `fechaCompromiso`, `observacion`, `compromiso`, `nombre_docente`, `firma_alumno`, `observador_id_observador`, `estudiante_id_estudiante`, `estudiante_registro_num_doc`, `estudiante_registro_rol_id_rol`, `estudiante_registro_jornada_id_jornada`) VALUES
(1, '2025-04-01', 'no vino con el uniforme adecuado', 'Se compromete a traer el uniforme adecuado los dias que son correspondidos', 'Yised Castiblanco', NULL, 1, 2, 1012366209, 6, 2),
(2, '2025-04-02', 'El alumno no entrego trabajos', 'Se compromete a entregar los trabajos el lunes alas 12 del día', 'Yised Castiblanco', NULL, 1, 2, 1012366209, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observador`
--

CREATE TABLE `observador` (
  `id_observador` int(11) NOT NULL,
  `num_doc` int(11) NOT NULL,
  `Tel_emergencia` char(25) DEFAULT NULL,
  `padre_nombre` char(90) DEFAULT NULL,
  `padre_apellido` char(90) DEFAULT NULL,
  `padre_ocupacion` char(150) DEFAULT NULL,
  `padre_cedula` char(15) DEFAULT NULL,
  `padre_direccion` varchar(260) DEFAULT NULL,
  `padre_telefono` char(13) DEFAULT NULL,
  `padre_correo` char(200) DEFAULT NULL,
  `madre_nombre` char(90) DEFAULT NULL,
  `madre_apellido` char(90) DEFAULT NULL,
  `madre_ocupacion` char(150) DEFAULT NULL,
  `madre_cedula` char(15) DEFAULT NULL,
  `madre_direccion` varchar(260) DEFAULT NULL,
  `madre_telefono` char(13) DEFAULT NULL,
  `madre_correo` char(200) DEFAULT NULL,
  `acudiente_nombre` char(90) DEFAULT NULL,
  `acudiente_apellido` char(90) DEFAULT NULL,
  `acudiente_ocupacion` char(150) DEFAULT NULL,
  `acudiente_cedula` char(15) DEFAULT NULL,
  `acudiente_direccion` varchar(260) DEFAULT NULL,
  `acudiente_telefono` char(13) DEFAULT NULL,
  `acudiente_correo` char(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observador`
--

INSERT INTO `observador` (`id_observador`, `num_doc`, `Tel_emergencia`, `padre_nombre`, `padre_apellido`, `padre_ocupacion`, `padre_cedula`, `padre_direccion`, `padre_telefono`, `padre_correo`, `madre_nombre`, `madre_apellido`, `madre_ocupacion`, `madre_cedula`, `madre_direccion`, `madre_telefono`, `madre_correo`, `acudiente_nombre`, `acudiente_apellido`, `acudiente_ocupacion`, `acudiente_cedula`, `acudiente_direccion`, `acudiente_telefono`, `acudiente_correo`) VALUES
(1, 0, '3014390312', 'Jose Alfonso', 'Castiblanco Barrantes', 'Supervizor', '800250346', NULL, '3002668256', NULL, 'Luz Adriana', 'Herrera Gonzales', 'Guarda de seguridad', '52762656', NULL, '3014390312', NULL, 'Luz Adriana', 'Herrera Gonzales', 'Guarda de seguridad', '52762656', NULL, '3014390312', NULL),
(2, 93481465, '3014390312', 'Jose Alfonso', 'Castiblanco', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `public_eventos`
--

CREATE TABLE `public_eventos` (
  `id_evento` int(11) NOT NULL,
  `img` longblob DEFAULT NULL,
  `evento` varchar(1500) DEFAULT NULL,
  `fecha_evento` date DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `public_eventos`
--

INSERT INTO `public_eventos` (`id_evento`, `img`, `evento`, `fecha_evento`, `registro_num_doc`) VALUES
(1, 0x61653331343732332d386661652d346361642d393139392d3233363665323731336536662e6a666966, 'Paseo familiar ', '2025-04-27', 1141114912),
(2, 0x61653331343732332d386661652d346361642d393139392d3233363665323731336536662e6a666966, 'Familia', '2025-04-25', 1141114912);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `public_noticias`
--

CREATE TABLE `public_noticias` (
  `id_noticia` int(11) NOT NULL,
  `titulo` char(100) DEFAULT NULL,
  `info` varchar(1500) DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `public_noticias`
--

INSERT INTO `public_noticias` (`id_noticia`, `titulo`, `info`, `registro_num_doc`) VALUES
(1, ' Convocatoria a Reunión de Padres de Familia – Segundo Período Académico', 'El Colegio CEDID San Pablo informa a toda la comunidad educativa que el próximo viernes 25 de abril de 2025 se realizará la Reunión de Padres de Familia correspondiente al segundo período académico, la cual tendrá lugar en el salón múltiple del colegio a las 7:00 a.m. para la jornada mañana y a las 12:30 p.m. para la jornada tarde. Durante este encuentro se socializarán los avances académicos, aspectos convivenciales y se entregarán los boletines informativos del segundo período. La asistencia de los padres y acudientes es fundamental para fortalecer el vínculo entre la familia y la institución, garantizando así el bienestar y desarrollo integral de nuestros estudiantes. Agradecemos su compromiso y puntualidad.', 1141114912),
(2, ' Entrega de Boletines del Primer Período Académico', 'El Colegio CEDID San Pablo informa a padres de familia y acudientes que la entrega de boletines correspondientes al primer período académico se realizará el próximo miércoles 23 de abril de 2025, en las instalaciones del colegio, en el horario de 7:00 a.m. a 12:00 m. para la jornada mañana y de 1:00 p.m. a 4:30 p.m. para la jornada tarde. Durante esta jornada, los padres podrán conocer el rendimiento académico de sus hijos y recibir recomendaciones por parte de los docentes para fortalecer los procesos de aprendizaje. Es importante la asistencia puntual y responsable de los acudientes, ya que esta información permite el acompañamiento adecuado en el desarrollo académico de los estudiantes.', 1141114912),
(3, ' Entrega de Boletines del Tercer Periodo Academico', 'El Colegio CEDID San Pablo informa a padres de familia y acudientes que la entrega de boletines correspondientes al primer período académico se realizará el próximo miércoles 23 de abril de 2025, en las instalaciones del colegio, en el horario de 7:00 a.m. a 12:00 m. para la jornada mañana y de 1:00 p.m. a 4:30 p.m. para la jornada tarde. Durante esta jornada, los padres podrán conocer el rendimiento académico de sus hijos y recibir recomendaciones por parte de los docentes para fortalecer los procesos de aprendizaje. Es importante la asistencia puntual y responsable de los acudientes, ya que esta información permite el acompañamiento adecuado en el desarrollo académico de los estudiantes.', 1141114912),
(7, ' Entrega de Boletines del Primer Período', 'El Colegio CEDID San Pablo informa a padres de familia y acudientes que la entrega de boletines correspondientes al primer período académico se realizará el próximo miércoles 23 de abril de 2025, en las instalaciones del colegio, en el horario de 7:00 a.m. a 12:00 m. para la jornada mañana y de 1:00 p.m. a 4:30 p.m. para la jornada tarde. Durante esta jornada, los padres podrán conocer el rendimiento académico de sus hijos y recibir recomendaciones por parte de los docentes para fortalecer los procesos de aprendizaje. Es importante la asistencia puntual y responsable de los acudientes, ya que esta información permite el acompañamiento adecuado en el desarrollo académico de los estudiantes.', 1141114912);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `num_doc` int(11) NOT NULL,
  `tipo_doc` char(15) DEFAULT NULL,
  `foto_perfil` longblob DEFAULT NULL,
  `nombres` char(45) DEFAULT NULL,
  `apellidos` char(45) DEFAULT NULL,
  `celular` char(12) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `direccion` char(45) DEFAULT NULL,
  `correo` char(45) DEFAULT NULL,
  `pass` char(200) DEFAULT NULL,
  `rol_id_rol` int(11) NOT NULL,
  `jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`num_doc`, `tipo_doc`, `foto_perfil`, `nombres`, `apellidos`, `celular`, `telefono`, `direccion`, `correo`, `pass`, `rol_id_rol`, `jornada_id_jornada`) VALUES
(52762656, 'CC', 0x363830383930656335643165345f696d616765732e6a666966, 'Luz Adriana', 'Herrera Gonzales', '3014390312', '3014390', 'Kr80 # 66 - 58', 'adriana@gmail.com', '$2y$10$juJz5eu4Zz7ll76z2snGS.8U5HPF.iLvX.l6KXGfc.7WCkhOx7x6K', 5, 1),
(93481465, 'CC', 0x363830393434636330303335365f39653636663565642d323731632d346338662d396363332d6633336662303836326337382e6a666966, 'Javier', 'Yara', '3202364445', '1234567', 'Calle 123 #45-67, Bogotá, Colombia', 'yised@gmail.com', '$2y$10$lPmA9jGvx6zXLM9AZPRH1.IqcDCfy/oemo9Py9KVKCCqA2k.XyGEi', 6, 2),
(1012345678, 'CC', 0x363830383963613532353835385f696d616765732e6a666966, 'Laura Sofia', 'Ramirez Lopez', '3004567890', '6014567', 'Calle 123 #45-67, Bogotá', 'laura.ramirez@example.com', '$2y$10$W0P.nbWjD7wNTWD7NKxGUuCgqq0Qg0u6W3z.jFf6XxiO/vnRbl.Gm', 5, 2),
(1012366209, 'TI', 0x363765636166306336393132305f49372d31302d32342e6a7067, 'Johan Stiven', 'Castiblanco Herrera', '3213675463', '1111111', 'CLL 80', 'johan@gmail.com', '$2y$10$rYcAAuqd5I5jBw9AwF5MIusCD1CWXQ2kpvc2KGzM9AH8KYi.vB5Zq', 6, 2),
(1028780775, 'CC', 0x363830393339373137633966305f696d616765732e6a666966, 'Darikson', 'Leon', '3045673209', '5499009', 'Calle 123 #45-67, Bogotá, Colombia', 'darikson@gmail.com', '$2y$10$bjskuvsjzcqZowBhDx6DPumL4TGhWLrzFd1FuezzLzExBgciLLuzq', 6, 1),
(1141114912, 'CC', 0x363765633630613763353661625f496d6167656e20646520576861747341707020323032352d30332d31342061206c61732031352e34352e31355f35346234306366302e6a7067, 'Yised Dayana', 'Castiblanco Herrera', '3213675463', '3213675', 'CLL 80', 'dylan@gmail.com', '$2y$10$VJw/yeK.oYDiqGMOiTHBYuYQ2c8zco8AlQStN6cdLghXfvAzrkK9K', 1, 1),
(1234567890, 'CC', 0x363830386262636530303935345f696d616765732e6a666966, 'Juan Carlos', 'Perez Garcia', '3101234567', '6012345', 'Calle 123 #45-67, Bogotá, Colombia', 'juancarlos.perez@email.com', '$2y$10$BHbDYRBr3cxfMz0Ilm58B./4sl49jxFooVR/pjViIP0wEsFGJeoSK', 2, 1),
(1234567891, 'CC', 0x363830656436636661333262635f39653636663565642d323731632d346338662d396363332d6633336662303836326337382e6a666966, 'Laura Sofia', 'Ramirez Lopez', '3213675466', '0', 'Calle 123 #45-67, Bogotá', 'yised@gmail.com', '$2y$10$UeDrJ3k3VzTwoAx6evZZbOazA6kUK7WETSQHs26xGxugu86Fv5GIe', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Coordinador'),
(3, 'Rector'),
(4, 'Secretaria'),
(5, 'Profesor'),
(6, 'Estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`,`docente_has_materia_docente_id_docente`,`docente_has_materia_materia_id_materia`,`logro_grado_id_grado`,`logro_id_logro`,`logro_materia_id_materia`),
  ADD KEY `fk_actividad_docente_has_materia1_idx` (`docente_has_materia_docente_id_docente`,`docente_has_materia_materia_id_materia`),
  ADD KEY `fk_actividad_logro1_idx` (`logro_grado_id_grado`,`logro_id_logro`,`logro_materia_id_materia`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`,`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_Asistencia_matricula1_idx` (`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`);

--
-- Indices de la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD PRIMARY KEY (`id_boletin`,`Observacion_idObservacion`,`nota_id_nota`,`nota_matricula_id_matricula`,`nota_actividad_id_actividad`),
  ADD KEY `fk_boletin_Observacion1_idx` (`Observacion_idObservacion`),
  ADD KEY `fk_boletin_nota1_idx` (`nota_id_nota`,`nota_matricula_id_matricula`,`nota_actividad_id_actividad`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_cursos`,`grado_id_grado`),
  ADD KEY `fk_cursos_grado1_idx` (`grado_id_grado`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`,`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`),
  ADD KEY `fk_docente_registro1_idx` (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`);

--
-- Indices de la tabla `docente_has_cursos`
--
ALTER TABLE `docente_has_cursos`
  ADD PRIMARY KEY (`docente_id_docente`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`,`cursos_id_cursos`,`cursos_grado_id_grado`),
  ADD KEY `fk_docente_has_cursos_cursos1_idx` (`cursos_id_cursos`,`cursos_grado_id_grado`),
  ADD KEY `fk_docente_has_cursos_docente1_idx` (`docente_id_docente`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`);

--
-- Indices de la tabla `docente_has_materia`
--
ALTER TABLE `docente_has_materia`
  ADD PRIMARY KEY (`docente_id_docente`,`materia_id_materia`),
  ADD KEY `fk_docente_has_materia_materia1_idx` (`materia_id_materia`),
  ADD KEY `fk_docente_has_materia_docente1_idx` (`docente_id_docente`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id_estudiante`,`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`),
  ADD KEY `fk_estudiante_registro1_idx` (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id_jornada`);

--
-- Indices de la tabla `logro`
--
ALTER TABLE `logro`
  ADD PRIMARY KEY (`grado_id_grado`,`id_logro`,`materia_id_materia`),
  ADD KEY `fk_logro_grado1_idx` (`grado_id_grado`),
  ADD KEY `fk_logro_materia1_idx` (`materia_id_materia`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`,`area_id_area`),
  ADD KEY `fk_materia_area1_idx` (`area_id_area`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_matricula`,`grado_id_grado`,`cursos_id_cursos`,`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_matricula_grado1_idx` (`grado_id_grado`),
  ADD KEY `fk_matricula_cursos1_idx` (`cursos_id_cursos`),
  ADD KEY `fk_matricula_estudiante1_idx` (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`,`matricula_id_matricula`,`actividad_id_actividad`),
  ADD KEY `fk_nota_matricula1_idx` (`matricula_id_matricula`),
  ADD KEY `fk_nota_actividad1_idx` (`actividad_id_actividad`);

--
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`idObservacion`,`observador_id_observador`,`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_Observacion_observador1_idx` (`observador_id_observador`),
  ADD KEY `fk_Observacion_estudiante1_idx` (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`);

--
-- Indices de la tabla `observador`
--
ALTER TABLE `observador`
  ADD PRIMARY KEY (`id_observador`);

--
-- Indices de la tabla `public_eventos`
--
ALTER TABLE `public_eventos`
  ADD PRIMARY KEY (`id_evento`,`registro_num_doc`),
  ADD KEY `fk_public_eventos_registro_idx` (`registro_num_doc`);

--
-- Indices de la tabla `public_noticias`
--
ALTER TABLE `public_noticias`
  ADD PRIMARY KEY (`id_noticia`,`registro_num_doc`),
  ADD KEY `fk_public_noticias_registro1_idx` (`registro_num_doc`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`num_doc`,`rol_id_rol`,`jornada_id_jornada`),
  ADD KEY `fk_registro_rol1_idx` (`rol_id_rol`),
  ADD KEY `fk_registro_jornada1_idx` (`jornada_id_jornada`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `boletin`
--
ALTER TABLE `boletin`
  MODIFY `id_boletin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_cursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id_jornada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `idObservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `observador`
--
ALTER TABLE `observador`
  MODIFY `id_observador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `public_eventos`
--
ALTER TABLE `public_eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `public_noticias`
--
ALTER TABLE `public_noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_actividad_docente_has_materia1` FOREIGN KEY (`docente_has_materia_docente_id_docente`,`docente_has_materia_materia_id_materia`) REFERENCES `docente_has_materia` (`docente_id_docente`, `materia_id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_actividad_logro1` FOREIGN KEY (`logro_grado_id_grado`,`logro_id_logro`,`logro_materia_id_materia`) REFERENCES `logro` (`grado_id_grado`, `id_logro`, `materia_id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_Asistencia_matricula1` FOREIGN KEY (`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`) REFERENCES `matricula` (`id_matricula`, `grado_id_grado`, `cursos_id_cursos`, `estudiante_id_estudiante`, `estudiante_registro_num_doc`, `estudiante_registro_rol_id_rol`, `estudiante_registro_jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD CONSTRAINT `fk_boletin_Observacion1` FOREIGN KEY (`Observacion_idObservacion`) REFERENCES `observacion` (`idObservacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_boletin_nota1` FOREIGN KEY (`nota_id_nota`,`nota_matricula_id_matricula`,`nota_actividad_id_actividad`) REFERENCES `nota` (`id_nota`, `matricula_id_matricula`, `actividad_id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_grado1` FOREIGN KEY (`grado_id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fk_docente_registro1` FOREIGN KEY (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`) REFERENCES `registro` (`num_doc`, `rol_id_rol`, `jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente_has_cursos`
--
ALTER TABLE `docente_has_cursos`
  ADD CONSTRAINT `fk_docente_has_cursos_cursos1` FOREIGN KEY (`cursos_id_cursos`,`cursos_grado_id_grado`) REFERENCES `cursos` (`id_cursos`, `grado_id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_docente_has_cursos_docente1` FOREIGN KEY (`docente_id_docente`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`) REFERENCES `docente` (`id_docente`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente_has_materia`
--
ALTER TABLE `docente_has_materia`
  ADD CONSTRAINT `fk_docente_has_materia_docente1` FOREIGN KEY (`docente_id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_docente_has_materia_materia1` FOREIGN KEY (`materia_id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_registro1` FOREIGN KEY (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`) REFERENCES `registro` (`num_doc`, `rol_id_rol`, `jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `logro`
--
ALTER TABLE `logro`
  ADD CONSTRAINT `fk_logro_grado1` FOREIGN KEY (`grado_id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_logro_materia1` FOREIGN KEY (`materia_id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_materia_area1` FOREIGN KEY (`area_id_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_cursos1` FOREIGN KEY (`cursos_id_cursos`) REFERENCES `cursos` (`id_cursos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matricula_estudiante1` FOREIGN KEY (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`) REFERENCES `estudiante` (`id_estudiante`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matricula_grado1` FOREIGN KEY (`grado_id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_actividad1` FOREIGN KEY (`actividad_id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_matricula1` FOREIGN KEY (`matricula_id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD CONSTRAINT `fk_Observacion_estudiante1` FOREIGN KEY (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`) REFERENCES `estudiante` (`id_estudiante`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Observacion_observador1` FOREIGN KEY (`observador_id_observador`) REFERENCES `observador` (`id_observador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `public_eventos`
--
ALTER TABLE `public_eventos`
  ADD CONSTRAINT `fk_public_eventos_registro` FOREIGN KEY (`registro_num_doc`) REFERENCES `registro` (`num_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `public_noticias`
--
ALTER TABLE `public_noticias`
  ADD CONSTRAINT `fk_public_noticias_registro1` FOREIGN KEY (`registro_num_doc`) REFERENCES `registro` (`num_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_jornada1` FOREIGN KEY (`jornada_id_jornada`) REFERENCES `jornada` (`id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registro_rol1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
