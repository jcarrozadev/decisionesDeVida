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
    idDialogo SMALLINT UNSIGNED NULL,
    idEscenario TINYINT UNSIGNED NULL,
    PRIMARY KEY (idRespuesta)
);

CREATE TABLE Dialogos (
    idDialogo SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreDiálogo VARCHAR(20) NOT NULL,
    mensaje VARCHAR(150) NOT NULL,
    casilla CHAR(2) NOT NULL,
    idNPC TINYINT UNSIGNED NOT NULL,
    idRespuesta1 TINYINT UNSIGNED NULL,
    idRespuesta2 TINYINT UNSIGNED NULL,
    idEscenario TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (idDialogo)
);

ALTER TABLE Respuestas 
ADD CONSTRAINT fk_idDialogo FOREIGN KEY (idDialogo) REFERENCES Dialogos(idDialogo),
ADD CONSTRAINT fk_idEscenarioRespuestas FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario);

ALTER TABLE Dialogos 
ADD CONSTRAINT fk_idNPC FOREIGN KEY (idNPC) REFERENCES NPC(idNPC),
ADD CONSTRAINT fk_idRespuesta1 FOREIGN KEY (idRespuesta1) REFERENCES Respuestas(idRespuesta),
ADD CONSTRAINT fk_idRespuesta2 FOREIGN KEY (idRespuesta2) REFERENCES Respuestas(idRespuesta),
ADD CONSTRAINT fk_idEscenarioDialogos FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario);
