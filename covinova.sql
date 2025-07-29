-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS covinova;
USE covinova;
-- Tabla Socio
CREATE TABLE if not exists Socio (
  CI                VARCHAR(20)    NOT NULL,
  nombre            VARCHAR(100)   NOT NULL,
  apellido          VARCHAR(100)   NOT NULL,
  direccion         VARCHAR(255),
  telefono          VARCHAR(20),
  email             VARCHAR(100),
  pago_mensual      DECIMAL(10,2),
  contraseña VARCHAR(255) NOT NULL,
  estado_pago VARCHAR(50),
  fecha_ingreso     DATE           NOT NULL,
  comprobante_pago_inicial BLOB,
  contraseña        VARCHAR(255)   NOT NULL,
  rol               ENUM('socio','tesorero','presidente','directivo') NOT NULL,
   imagen BLOB,
  PRIMARY KEY (CI),
  UNIQUE KEY (telefono),
  UNIQUE KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla UnidadHabitacional
CREATE TABLE if not exists UnidadHabitacional (
  id_unidad         INT            NOT NULL AUTO_INCREMENT,
  bloque            VARCHAR(50),
  nro_de_puerta     VARCHAR(20),
  cant_dormitorios  INT,
  cant_baños        INT,
  superficie_total  DECIMAL(10,2),
  PRIMARY KEY (id_unidad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla Asignada (relación Socio ↔ UnidadHabitacional)
CREATE TABLE if not exists Asignada (
  CI         VARCHAR(20) NOT NULL,
  id_unidad  INT         NOT NULL,
  PRIMARY KEY (CI, id_unidad),
  CONSTRAINT fk_asig_socio        FOREIGN KEY (CI)        REFERENCES Socio(CI)             ON DELETE CASCADE,
  CONSTRAINT fk_asig_unidad       FOREIGN KEY (id_unidad) REFERENCES UnidadHabitacional(id_unidad) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla Obra
CREATE TABLE if not exists Obra (
  id_trabajo                           INT            NOT NULL AUTO_INCREMENT,
  solicitud_exoneracion                TEXT,
  pago_compensatorio_comprobante       VARCHAR(255),
  validado_administrativo              BOOLEAN        DEFAULT FALSE,
  causa_inasistencia                   TEXT,
  tipo_tarea                           VARCHAR(255),
  horas_trabajadas                     DECIMAL(10,2),
  fecha                                DATE,
  PRIMARY KEY (id_trabajo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla trabaja_en (relación Socio ↔ Obra)
CREATE TABLE if not exists trabaja_en (
  CI         VARCHAR(20) NOT NULL,
  id_trabajo INT         NOT NULL,
  PRIMARY KEY (CI, id_trabajo),
  CONSTRAINT fk_trab_socio   FOREIGN KEY (CI)        REFERENCES Socio(CI)    ON DELETE CASCADE,
  CONSTRAINT fk_trab_obra    FOREIGN KEY (id_trabajo) REFERENCES Obra(id_trabajo) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla MetodoPago
CREATE TABLE if not exists MetodoPago (
  id_pago              INT          NOT NULL AUTO_INCREMENT,
  descripcion          VARCHAR(255),
  es_tarjeta           BOOLEAN      NOT NULL ,
  tipo_tarjeta         VARCHAR(20)  ,
  propietario_tarjeta  VARCHAR(40),
  PRIMARY KEY (id_pago)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla Pago
CREATE TABLE if not exists Pago (
  id_pago            INT            NOT NULL,
  CI                 VARCHAR(20)    NOT NULL,
  fecha_pago         DATE,
  fecha_inicio       DATE,
  fecha_límite       DATE,
  plazo              INT,
  comprobante        VARCHAR(255),
  monto              DECIMAL(10,2),
  pago_a_tiempo      BOOLEAN        DEFAULT FALSE,
  PRIMARY KEY (id_pago),
  CONSTRAINT fk_pago_socio     FOREIGN KEY (CI)      REFERENCES Socio(CI),
  CONSTRAINT fk_pago_metodo    FOREIGN KEY (id_pago)  REFERENCES MetodoPago(id_pago)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla Sanciones
CREATE TABLE if not exists Sanciones (
  id_sancion        INT            NOT NULL AUTO_INCREMENT,
  CI_socio          VARCHAR(20)    NOT NULL,
  motivo            TEXT,
  estado_sancion    VARCHAR(50),
  importe_sancion   DECIMAL(10,2),
  tipo_sancion      VARCHAR(50),
  fecha_emisión     DATE,
  comprobante       VARCHAR(255),
  PRIMARY KEY (id_sancion),
  CONSTRAINT fk_sanc_socio  FOREIGN KEY (CI_socio) REFERENCES Socio(CI) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla citas
CREATE TABLE if not exists Agendas (
    id_agenda INT PRIMARY KEY AUTO_INCREMENT,
    fecha_agendada DATE NOT NULL,
    nombre VARCHAR(100)  NOT NULL, 
	apellido VARCHAR(100)  NOT NULL,
	estado_agenda VARCHAR(255)  NOT NULL,
	fecha_nacimiento date  NOT NULL,
    hora TIME NOT NULL,
	CONSTRAINT uc_fecha_agendada UNIQUE (fecha_agendada, hora)
);
