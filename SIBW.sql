-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database:3306
-- Tiempo de generación: 12-06-2023 a las 10:57:59
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SIBW`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CIENTIFICOS`
--

CREATE TABLE `CIENTIFICOS` (
  `IDCientifico` int NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Biografia` text NOT NULL,
  `Web` varchar(100) NOT NULL,
  `Facebook` varchar(100) NOT NULL,
  `Twitter` varchar(100) NOT NULL,
  `FechaMuerte` date NOT NULL,
  `FotoPortada` varchar(100) NOT NULL,
  `Publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `CIENTIFICOS`
--

INSERT INTO `CIENTIFICOS` (`IDCientifico`, `Nombre`, `FechaNacimiento`, `Lugar`, `Biografia`, `Web`, `Facebook`, `Twitter`, `FechaMuerte`, `FotoPortada`, `Publicado`) VALUES
(1, 'Albert Einstein', '1879-03-14', 'Ulm,Alemania', '\r\n  Albert Einstein fue un físico alemán de origen judío que nació en Ulm, Alemania, en 1879. Es conocido como uno de los científicos más influyentes de la historia, y su teoría de la relatividad es uno de los descubrimientos más importantes en la física moderna.\r\n\r\n  Einstein era un estudiante brillante, pero tuvo problemas en la escuela debido a su falta de interés en la memorización de datos. A los 16 años, abandonó la escuela y se trasladó a Suiza para continuar sus estudios. En 1905, mientras trabajaba como empleado de patentes en Berna, Suiza, Einstein publicó una serie de artículos que revolucionaron la física y lo hicieron famoso en todo el mundo.\r\n\r\n  En estos artículos, Einstein propuso su teoría de la relatividad especial, que se basa en la idea de que el tiempo y el espacio son relativos y no absolutos. También propuso la famosa ecuación E=mc², que relaciona la masa y la energía.\r\n\r\n  En 1915, Einstein publicó su teoría de la relatividad general, que amplió su teoría de la relatividad especial para incluir la gravedad. La teoría de la relatividad general ha sido ampliamente aceptada y ha sido verificada en numerosos experimentos.\r\n\r\n  Einstein también fue un defensor de la paz y los derechos humanos, y utilizó su fama para hacer campaña por la abolición de las armas nucleares y la cooperación internacional. En 1921, recibió el Premio Nobel de Física por su explicación del efecto fotoeléctrico.\r\n\r\n  Einstein murió en Princeton, Nueva Jersey, en 1955, a los 76 años. Su legado en la física y en la cultura popular ha sido duradero, y sigue siendo una figura icónica en la ciencia y en la cultura popular.\r\n', 'https://einstein-website.de/en/', 'https://www.facebook.com/albert.einstein.fans/', 'https://twitter.com/AlbertEinstein', '1955-04-18', 'logos/einstein.jpg', 1),
(2, 'Marie Curie', '1867-11-07', 'Varsovia,Polonia', '\r\n            Marie Curie, nacida como Maria Salomea Sklodowska en Polonia en 1867, fue una física y química pionera en la investigación sobre la radiactividad. Junto con su esposo Pierre Curie, descubrió los elementos radio y polonio, y fue la primera mujer en ganar un Premio Nobel en Física en 1903.\r\n\r\n            Más tarde, en 1911, se convirtió en la primera persona en ganar dos premios Nobel, esta vez en Química, por su investigación sobre el radio y el polonio. El trabajo de Curie ha tenido un impacto duradero en la física, la química y la medicina, y su legado sigue inspirando a científicos de todo el mundo.\r\n\r\n            Curie era una estudiante brillante, pero tuvo dificultades para continuar sus estudios debido a la discriminación de género en la educación superior. A pesar de esto, logró graduarse en física y matemáticas en la Universidad de París en 1893, y posteriormente obtuvo su doctorado en física en 1903.\r\n\r\n            Además de sus importantes descubrimientos en la radiactividad, Curie también hizo importantes contribuciones a la medicina durante la Primera Guerra Mundial, desarrollando unidades móviles de rayos X para tratar a soldados heridos. Fue la primera mujer en ser profesora en la Universidad de París y fue la primera mujer en ser enterrada en el Panteón de París por sus logros en la ciencia.\r\n\r\n            Marie Curie murió en Francia en 1934, a los 66 años, a causa de la exposición prolongada a la radiación. A pesar de los obstáculos que enfrentó como mujer en la ciencia, su trabajo y dedicación continúan siendo un ejemplo inspirador para todos aquellos que buscan descubrir nuevos conocimientos y avanzar en la ciencia y la tecnología.\r\n   ', 'https://marie-sklodowska-curie-actions.ec.europa.eu/', 'https://facebook.com', 'https://twitter.com/MSCActions', '1934-07-04', 'logos/curie.jpg', 1),
(3, 'Charles Darwin', '1809-02-12', 'Shrewsbury,Reino Unido', '\r\n    Charles Robert Darwin fue un naturalista, geólogo y biólogo inglés nacido en Shrewsbury, Inglaterra, en 1809. Es conocido por su teoría de la evolución, que revolucionó la biología y nuestra comprensión del mundo natural.\r\n\r\n    Darwin era el quinto de seis hijos y provenía de una familia acomodada y culta. Desde joven, mostró un gran interés por la naturaleza y por la ciencia, y a menudo se dedicaba a recolectar muestras de plantas y animales en su tiempo libre.\r\n\r\n    En 1831, Darwin se unió a una expedición científica que se dirigía alrededor del mundo a bordo del HMS Beagle. Durante los cinco años que duró la expedición, Darwin estudió la geología, la botánica, la zoología y la antropología de los lugares que visitaron. Fue en esta expedición donde Darwin comenzó a desarrollar su teoría de la evolución, basada en la idea de que las especies cambian a lo largo del tiempo como resultado de la selección natural.\r\n\r\n    Después de regresar a Inglaterra, Darwin dedicó muchos años a investigar y recopilar pruebas para su teoría de la evolución. Finalmente, en 1859, publicó su libro \"El origen de las especies\", que presentaba su teoría detalladamente y proporcionaba pruebas de apoyo.\r\n\r\n    La teoría de la evolución de Darwin fue recibida con escepticismo y críticas por algunos sectores de la sociedad, especialmente por aquellos que creían en la creación divina. Sin embargo, a medida que se acumularon más pruebas científicas, la teoría de Darwin se convirtió en la explicación dominante para la diversidad de la vida en la Tierra.\r\n\r\n    Darwin también contribuyó a otros campos de la ciencia, como la geología y la botánica, y fue un defensor del movimiento abolicionista y de los derechos humanos. Murió en 1882 en Down House, Kent, Inglaterra, dejando un legado duradero en la biología y en nuestra comprensión del mundo natural.\r\n', 'http://darwin-online.org.uk/', 'https://es-es.facebook.com/charlesdarwinfoundation/', 'https://twitter.com/DarwinFound', '1882-04-19', 'logos/darwin.jpg', 1),
(4, 'Rosalind Franklin', '1920-07-25', 'Londres,Reino Unido', '\r\nRosalind Franklin fue una química y cristalógrafa británica nacida en Londres en 1920. Es conocida por su trabajo pionero en la cristalografía de rayos X, que ayudó a descubrir la estructura del ADN.\r\n\r\nFranklin asistió a la Universidad de Cambridge, donde estudió química física. Después de graduarse, se trasladó a París para trabajar en el Laboratorio Central de Investigaciones Científicas. Allí, comenzó a trabajar en la cristalografía de rayos X, una técnica que utiliza rayos X para estudiar la estructura de los materiales. Su trabajo en París le permitió desarrollar su habilidad en la cristalografía y trabajar en la estructura del carbón, lo que le valió un doctorado en 1945.\r\n\r\nEn 1951, Franklin se unió al Kings College de Londres, donde comenzó a trabajar en la estructura del ADN. Usando su experiencia en cristalografía de rayos X, Franklin realizó experimentos que permitieron a su colega Maurice Wilkins obtener imágenes de rayos X del ADN. Estas imágenes fueron cruciales para que Francis Crick y James Watson, también científicos en el Kings College, descubrieran la estructura en doble hélice del ADN.\r\n\r\nA pesar de su contribución clave a la identificación de la estructura del ADN, el trabajo de Franklin fue pasado por alto y minimizado por sus colegas masculinos en el Kings College. Su trabajo también se vio obstaculizado por la falta de recursos y el apoyo insuficiente por parte de sus superiores en la universidad. Trágicamente, Franklin murió de cáncer de ovario en 1958, a la edad de 37 años, antes de que el Premio Nobel de Fisiología o Medicina fuera otorgado a Crick, Watson y Wilkins en 1962.\r\n\r\nEn los años posteriores a su muerte, el trabajo y el legado de Franklin han sido cada vez más reconocidos y valorados. Su papel en el descubrimiento de la estructura del ADN y su trabajo en la cristalografía de rayos X han sido fundamentales en la comprensión de la biología y la química modernas. Además, su carrera y su éxito han servido como un modelo a seguir para las mujeres que trabajan en la ciencia y la investigación.\r\n', 'https://www.rosalindfranklin.edu/about/facts-figures/dr-rosalind-franklin/', 'https://www.facebook.com/people/Rosalind-Franklin-Blog/100063537192247/', 'https://twitter.com/RosFrankInst', '1958-04-16', 'logos/franklin.jpg', 1),
(5, 'Galileo Galilei', '1564-02-15', 'Pisa,Italia', '\r\nGalileo Galilei fue un científico italiano nacido en Pisa en 1564. Es considerado uno de los más grandes astrónomos y físicos de la historia y uno de los principales impulsores de la revolución científica en Europa.\r\n\r\nGalileo estudió matemáticas y física en la Universidad de Pisa, donde se interesó por el movimiento de los objetos y la teoría de la caída libre. Tras sus estudios, trabajó como profesor de matemáticas en la Universidad de Pisa y en la Universidad de Padua, donde hizo importantes descubrimientos en los campos de la astronomía y la física.\r\n\r\nEn 1609, Galileo construyó un telescopio y comenzó a hacer observaciones astronómicas, descubriendo cuatro satélites orbitando Júpiter, las fases de Venus y las manchas solares. Estas observaciones apoyaron la teoría heliocéntrica de Copérnico, que sostiene que el Sol está en el centro del sistema solar y que la Tierra y los demás planetas giran alrededor de él.\r\n\r\nSin embargo, sus ideas revolucionarias no fueron bien recibidas por la Iglesia Católica, que consideraba que contradecían la Biblia y amenazaban la autoridad de la Iglesia. En 1633, Galileo fue juzgado por la Inquisición y condenado por herejía por sostener que la Tierra se mueve alrededor del Sol. Fue obligado a retractarse públicamente de sus ideas y pasó el resto de su vida bajo arresto domiciliario en Florencia, donde continuó trabajando y haciendo importantes contribuciones a la física y la matemática.\r\n\r\nGalileo es conocido por su trabajo en la mecánica, la astronomía y la filosofía natural. Sus descubrimientos sentaron las bases de la física moderna y tuvieron un gran impacto en el pensamiento científico. Galileo murió en Florencia en 1642, pero su legado ha sido duradero y sigue siendo una figura clave en la historia de la ciencia.\r\n', 'https://es.wikipedia.org/wiki/Galileo_Galilei', 'https://www.facebook.com', 'https://www.twitter.com', '1642-01-08', 'logos/galilei.jpg', 1),
(6, 'Alan Turing', '1912-06-23', 'Londres,Reino Unido', 'Alan Turing fue un matemático y científico de la computación británico, nacido en Londres en 1912. Turing es conocido como uno de los padres de la informática moderna, gracias a su trabajo pionero en la teoría de la computación y en la criptografía.\r\n\r\nEn 1936, Turing publicó un trabajo que se convirtió en la base de la teoría de la computación moderna, donde propuso el concepto de una máquina universal, que sería capaz de llevar a cabo cualquier tarea computacional mediante la ejecución de un conjunto de instrucciones. Este trabajo fue fundamental en el desarrollo de los ordenadores modernos.\r\n\r\nDurante la Segunda Guerra Mundial, Turing trabajó para descifrar los códigos de comunicación utilizados por los nazis, desarrollando una máquina llamada \"Bombe\" para descifrar los códigos de la máquina alemana Enigma. Su trabajo en criptografía fue crucial para la victoria de los Aliados en la guerra.\r\n\r\nA pesar de sus importantes contribuciones a la tecnología y a la seguridad del país, Turing fue perseguido por su homosexualidad, que en aquellos tiempos era considerada un delito en el Reino Unido. En 1952, fue condenado por este motivo y se le obligó a someterse a terapia hormonal. Turing falleció dos años después, en 1954, a la edad de 41 años, a causa de una intoxicación por cianuro. Su muerte fue considerada como un suicidio.\r\n\r\nEn 2009, el entonces Primer Ministro británico, Gordon Brown, pidió disculpas públicas en nombre del gobierno británico por la manera en que se trató a Turing, y en 2013, la Reina Isabel II le concedió un perdón real póstumo. Turing sigue siendo una figura importante en la historia de la ciencia y de la lucha por los derechos civiles, y su legado ha inspirado a generaciones de científicos y activistas.\r\n', 'https://www.turing.org.uk/', 'https://www.facebook.com/AlanTuringCodebreaker/?locale=es_ES', 'https://twitter.com/turinginst', '1954-06-07', 'logos/turing.jpg', 1),
(7, 'Albert Einstein 2', '0222-02-22', 'f', 'f', 'f', 'f', 'f', '3333-03-23', 'logos/Albert Einstein 2MESSI2.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COMENTARIOS`
--

CREATE TABLE `COMENTARIOS` (
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Texto` text NOT NULL,
  `Fecha` datetime NOT NULL,
  `IDComentario` int NOT NULL,
  `IDCientifico` int NOT NULL,
  `Editado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `COMENTARIOS`
--

INSERT INTO `COMENTARIOS` (`Nombre`, `Email`, `Texto`, `Fecha`, `IDComentario`, `IDCientifico`, `Editado`) VALUES
('Fernando Pastrana', 'fer@mail.com', 'Me gusta mucho esta web, es muy útil.', '2023-03-16 20:56:19', 1, 1, 1),
('Juan del Moral', 'juan@mail.com', 'Einstein es mi científico favorito ivan ', '2023-02-17 12:44:00', 2, 1, 1),
('josemi', 'josemi@mail.com', 'Es mi cientifica favorita', '2023-05-29 10:36:32', 17, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HASHTAGS`
--

CREATE TABLE `HASHTAGS` (
  `IDCientifico` int NOT NULL,
  `Hashtag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `HASHTAGS`
--

INSERT INTO `HASHTAGS` (`IDCientifico`, `Hashtag`) VALUES
(1, 'Alemania'),
(1, 'Einstein'),
(1, 'físico'),
(1, 'jamon'),
(1, 'Ulm'),
(2, 'Curie'),
(2, 'Polonia'),
(2, 'radiactividad'),
(2, 'Varsovia'),
(3, 'biologia'),
(3, 'Darwin'),
(3, 'evolución'),
(3, 'Shrewsbury'),
(4, 'Londres'),
(4, 'química'),
(4, 'rayos'),
(5, 'Galilei'),
(5, 'Italia'),
(5, 'Pisa'),
(5, 'Sol'),
(6, 'alan'),
(6, 'informatico'),
(6, 'londres'),
(6, 'matematico'),
(6, 'turing'),
(7, 'ibai');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IMAGENES`
--

CREATE TABLE `IMAGENES` (
  `IDCientifico` int NOT NULL,
  `Ruta` varchar(100) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `IMAGENES`
--

INSERT INTO `IMAGENES` (`IDCientifico`, `Ruta`, `Descripcion`) VALUES
(1, 'logos/einstein-joven.jpg', 'Foto de Einstein de joven'),
(1, 'logos/einstein.jpg', 'Foto 1 de Einstein'),
(2, 'logos/curie.jpg', 'Foto de Marie Curie'),
(2, 'logos/mariecurie2.jpg', 'Foto de Marie Curie'),
(3, 'logos/darwin.jpg', 'Foto de Charles Darwin'),
(3, 'logos/darwin2.jpg', 'Foto de Charles Darwin'),
(4, 'logos/franklin.jpg', 'Foto de Rosalind Franklin'),
(4, 'logos/franklin2.jpg', 'Foto de Rosalind Franklin'),
(5, 'logos/galilei.jpg', 'Foto de Galileo Galilei'),
(5, 'logos/galilei2.jpg', 'Foto de Galileo Galilei'),
(6, 'logos/turing.jpg', 'Foto de Alan Turing'),
(6, 'logos/turing2.jpg', 'Foto de Alan Turing'),
(7, 'logos/Albert Einstein 2MESSI2.jpg', 'ese');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROHIBIDAS`
--

CREATE TABLE `PROHIBIDAS` (
  `PALABRA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `PROHIBIDAS`
--

INSERT INTO `PROHIBIDAS` (`PALABRA`) VALUES
('bobo'),
('estupido'),
('fraude'),
('gilipollas'),
('idiota'),
('imbecil'),
('mierda'),
('payaso'),
('subnormal'),
('tonto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `ID` int NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TipoUsuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`ID`, `Usuario`, `Contraseña`, `TipoUsuario`, `Email`) VALUES
(1, 'fer', '$2y$10$r6vjQvKr8GJ2X1bSUqU6pOSV85opCMQif8fw9Ljzut8pPR89eFDjC', 'SUPERUSUARIO', 'fer@gmail.com'),
(24, 'eva', '$2y$10$6WX9sVlXqnN22SVURIukret/CPRFZlQaoQ.THKyl6ha6027j7W.Xy', 'GESTOR', 'eva@gmail.com'),
(25, 'juanmi', '$2y$10$mxLUi9FoOLDERxiaX944vuoL2qQxX5Y3LebUo1vi/qsY9Vy0xctia', 'MODERADOR', 'juanmi@mail.com'),
(26, 'josemi12', '$2y$10$4bfExUWbckG9nX6HnAezheClAdZglF4pLdJ7c95Rsw.GMI0YR6yYm', 'REGISTRADO', 'josemi@mail.com'),
(27, 'ivan', '$2y$10$PaS9yudjONgzG8SKWLAKeON3IypVgs5fHjuGb4GaKmi4DW0Shslyq', 'GESTOR', 'ivan@ivan.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CIENTIFICOS`
--
ALTER TABLE `CIENTIFICOS`
  ADD PRIMARY KEY (`IDCientifico`);

--
-- Indices de la tabla `COMENTARIOS`
--
ALTER TABLE `COMENTARIOS`
  ADD PRIMARY KEY (`IDComentario`),
  ADD KEY `ComentarioCientifico` (`IDCientifico`);

--
-- Indices de la tabla `HASHTAGS`
--
ALTER TABLE `HASHTAGS`
  ADD PRIMARY KEY (`IDCientifico`,`Hashtag`);

--
-- Indices de la tabla `IMAGENES`
--
ALTER TABLE `IMAGENES`
  ADD PRIMARY KEY (`IDCientifico`,`Ruta`);

--
-- Indices de la tabla `PROHIBIDAS`
--
ALTER TABLE `PROHIBIDAS`
  ADD PRIMARY KEY (`PALABRA`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `COMENTARIOS`
--
ALTER TABLE `COMENTARIOS`
  MODIFY `IDComentario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `COMENTARIOS`
--
ALTER TABLE `COMENTARIOS`
  ADD CONSTRAINT `ComentarioCientifico` FOREIGN KEY (`IDCientifico`) REFERENCES `CIENTIFICOS` (`IDCientifico`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `HASHTAGS`
--
ALTER TABLE `HASHTAGS`
  ADD CONSTRAINT `HASHTAGS_ibfk_1` FOREIGN KEY (`IDCientifico`) REFERENCES `CIENTIFICOS` (`IDCientifico`);

--
-- Filtros para la tabla `IMAGENES`
--
ALTER TABLE `IMAGENES`
  ADD CONSTRAINT `ImagenCientifico` FOREIGN KEY (`IDCientifico`) REFERENCES `CIENTIFICOS` (`IDCientifico`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
