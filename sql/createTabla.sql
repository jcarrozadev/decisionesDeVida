-- Javier Arias Carroza

/* Creación de tablas */

CREATE TABLE NPC (
    idNPC TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreNPC VARCHAR(20) NOT NULL UNIQUE,
    sprite BLOB NOT NULL,
    PRIMARY KEY (idNPC)
);

CREATE TABLE Escenario (
    idEscenario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreEscenario VARCHAR(30) NOT NULL,
    nombreImagen VARCHAR(20) NOT NULL,
    mensajeNarrativo VARCHAR(150) NOT NULL,
    PRIMARY KEY (idEscenario)
);

CREATE TABLE Respuestas (
    idRespuesta TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    mensaje VARCHAR(30) NOT NULL,
    dinero VARCHAR(20) NOT NULL,
    tiempo VARCHAR(150) NOT NULL,
    idDiálogo SMALLINT UNSIGNED NOT NULL,
    idEscenario TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (idRespuesta),
    FOREIGN KEY (idDiálogo) REFERENCES Diálogos(idDiálogo),
    FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario)
);

CREATE TABLE Diálogos (
    idDiálogo SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreDiálogo VARCHAR(20) NOT NULL,
    mensaje VARCHAR(150) NOT NULL,
    casilla CHAR(2) NOT NULL,
    idNPC TINYINT UNSIGNED NOT NULL,
    idRespuesta1 TINYINT UNSIGNED NOT NULL,
    idRespuesta2 TINYINT UNSIGNED NOT NULL,
    idEscenario TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (idDiálogo),
    FOREIGN KEY (idNPC) REFERENCES NPC(idNPC),
    FOREIGN KEY (idRespuesta1) REFERENCES Respuestas(idRespuesta),
    FOREIGN KEY (idRespuesta2) REFERENCES Respuestas(idRespuesta),
    FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario)
);
