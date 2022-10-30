CREATE DATABASE IF NOT EXISTS agenda_telefonica;
USE agenda_telefonica;

CREATE TABLE contacto (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  apellido VARCHAR(255) NOT NULL,
  numero VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO contacto (name, apellido, numero, direccion, email) VALUES
  ('Andrea', 'Martinez', '967356823', 'Queretaro', 'an@mar.com'),
  ('Uriel', 'Loaiza', '898246889', 'Tlaxcala', 'uri@loa.com'),
  ('Juan', 'Perez', '124785057', 'Guanajuato', 'juan@perez.com');


