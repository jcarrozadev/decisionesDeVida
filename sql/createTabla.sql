CREATE TABLE Personaje (
    idPersonaje TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombrePersonaje VARCHAR(50) NOT NULL,
    spriteFront BLOB NOT NULL,
    spriteBack BLOB NOT NULL,
    spriteLeft BLOB NOT NULL,
    spriteRight BLOB NOT NULL,
    PRIMARY KEY (idPersonaje)
);

CREATE TABLE Jugador (
    idJugador TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    tiempoTotal SMALLINT UNSIGNED NOT NULL,
    dineroTotal SMALLINT NOT NULL,
    idPersonaje TINYINT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY (idJugador),
    CONSTRAINT fk_idPersonaje FOREIGN KEY (idPersonaje) REFERENCES Personaje(idPersonaje)
);