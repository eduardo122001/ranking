DROP DATABASE ranking_estudiantes;
CREATE DATABASE ranking_estudiantes;
USE ranking_estudiantes;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    dni VARCHAR(255) UNIQUE,
    rol_id INT,
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

CREATE TABLE carreras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE semestres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10) NOT NULL
);


CREATE TABLE pesos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    semestre_id INT,

    rendimiento DECIMAL(5,2),
    comportamiento DECIMAL(5,2),
    pagos DECIMAL(5,2),
    referente DECIMAL(5,2),

    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (semestre_id) REFERENCES semestres(id)
);
CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    semestre_estudiante INT,
    semestre_id INT,
    carrera_id INT,
    
    rendimiento DECIMAL(5,2),
    comportamiento DECIMAL(5,2),
    pagos DECIMAL(5,2),
    referente DECIMAL(5,2),

    promedio DECIMAL(5,2),
    ranking INT,

    UNIQUE(estudiante_id, semestre_id, carrera_id),

    FOREIGN KEY (semestre_id) REFERENCES semestres(id),
    FOREIGN KEY (estudiante_id) REFERENCES usuarios(id),
    FOREIGN KEY (carrera_id) REFERENCES carreras(id)

);
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    autor_id INT,
    accion VARCHAR(100) NOT NULL,

    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (autor_id) REFERENCES usuarios(id)
);


CREATE VIEW ranking_view AS
SELECT
    n.id,

    u.nombre AS estudiante,
    u.dni,

    n.semestre_estudiante,

    s.nombre AS semestre,

    c.nombre AS carrera,

    n.rendimiento,
    n.comportamiento,
    n.pagos,
    n.referente,

    n.promedio,
    n.ranking

FROM notas n

JOIN usuarios u
    ON n.estudiante_id = u.id

JOIN semestres s
    ON n.semestre_id = s.id

JOIN carreras c
    ON n.carrera_id = c.id

ORDER BY
    n.semestre_estudiante DESC,
    c.nombre ASC,
    n.ranking ASC;


INSERT INTO roles (nombre) VALUES
('estudiante'),
('tutor'),
('administrador');  

INSERT INTO usuarios (nombre, email, dni, rol_id) VALUES
('Juan Perez', 'juan.perez@gmail.com', '11111111', 1),
('Maria Lopez', 'maria@gmail.com', '22222222', 1),
('Carlos Ruiz', 'carlos@gmail.com', '33333333', 2);

INSERT INTO carreras (nombre) VALUES
('Gastronomia'),
('Administracion');

INSERT INTO semestres (nombre) VALUES
('2024-1'),
('2024-2'),
('2025-1');

INSERT INTO pesos (semestre_id, rendimiento, comportamiento, pagos, referente) VALUES
(1,  0.4, 0.2, 0.2, 0.2),
(1,  0.3, 0.3, 0.2, 0.2),
(2,  0.5, 0.2, 0.2, 0.1);

INSERT INTO notas (
    estudiante_id, semestre_id, carrera_id,semestre_estudiante,
    rendimiento, comportamiento, pagos, referente,
    promedio, ranking
) VALUES
(1, 1, 1, 2, 15, 18, 17, 16, 16.5, 1),
(2, 1, 1, 3, 14, 15, 16, 15, 15.0, 2),
(1, 2, 2, 4, 18, 17, 19, 18, 18.0, 1);

INSERT INTO logs (autor_id, accion) VALUES
(1, 'Registro de notas inicial'),
(2, 'Actualizacion de notas'),
(3, 'Creacion de pesos');