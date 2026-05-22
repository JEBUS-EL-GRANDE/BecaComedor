--01 Tabla: PERSONAS
CREATE TABLE personas (
    id_personal INTEGER PRIMARY KEY,
    nombre CHAR(50) NOT NULL,
    apellido CHAR(50) NOT NULL,
    telefono CHAR(15),
    email CHAR(50),
    contrasena VARCHAR(50) NOT NULL,
    sexo CHAR(1) NOT NULL,
    ci CHAR(20) UNIQUE NOT NULL,
    direccion CHAR(100),
    rol CHAR(30) 
);

--02 Tabla: ADMINISTRADOR
CREATE TABLE administrador (
    id_administrador INTEGER PRIMARY KEY,
    ultimo_acceso DATE NOT NULL,
    fecha_inicio_rol DATE NOT NULL,
    id_personal INTEGER NOT NULL,
    FOREIGN KEY (id_personal) REFERENCES personas(id_personal)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

--03 Tabla: ENCARGADO
CREATE TABLE encargado (
    id_encargado INTEGER PRIMARY KEY,
    cargo CHAR(50) NOT NULL,
    turno CHAR(20) NOT NULL,
    id_personal INTEGER NOT NULL,
    FOREIGN KEY (id_personal) REFERENCES personas(id_personal)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

--04 Tabla: PERSONAL_COCINA
CREATE TABLE personal_cocina (
    id_personal INTEGER PRIMARY KEY,
    especialidad CHAR(50),
    horario_trabajo CHAR(50),
    FOREIGN KEY (id_personal) REFERENCES personas(id_personal)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

--05 Tabla: PARTICULAR
CREATE TABLE particular (
    id_personal INTEGER PRIMARY KEY,
    tipo_particular CHAR(50),
    FOREIGN KEY (id_personal) REFERENCES personas(id_personal)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

--06 Tabla: CARRERA
CREATE TABLE carrera (
    id_carrera INTEGER PRIMARY KEY,
    nombre_carrera CHAR(50) NOT NULL
);

--07 Tabla: ESTUDIANTE
CREATE TABLE estudiante (
    id_registro INTEGER PRIMARY KEY,
    promedio_academico NUMERIC(4, 2),
    situacion_academica CHAR(50),
    id_personal INTEGER NOT NULL,
    id_carrera INTEGER NOT NULL,
    FOREIGN KEY (id_personal) REFERENCES personas(id_personal)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (id_carrera) REFERENCES carrera(id_carrera)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

--08 Tabla: TIPO
CREATE TABLE tipo_beca (
    id_tipo INTEGER PRIMARY KEY,
    tipo_beca CHAR(50),
    duracion INTEGER,
    descripcion CHAR(100)
);

--09 Tabla: CONTROL_ASISTENCIA
CREATE TABLE control_asistencia (
    id_asistencia INTEGER PRIMARY KEY,
    tipo_servicio CHAR(50),
    observacion CHAR(100),
    fecha DATE NOT NULL,
    id_estudiante INTEGER NOT NULL,
    FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_registro)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

--10 Tabla: TIPO_SERVICIO
CREATE TABLE tipo_servicio (
    id_tipo_servicio INTEGER PRIMARY KEY,
    nombre_servicio CHAR(50) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL
);