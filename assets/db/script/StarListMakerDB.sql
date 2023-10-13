----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- DROP DATABASE StarListMakerDB;
-- CREATE DATABASE StarListMakerDB;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

/*
DROP TABLE IF EXISTS public.list;
DROP TABLE IF EXISTS public.product;
DROP TABLE IF EXISTS public.brand;
DROP TABLE IF EXISTS public.category;
DROP TABLE IF EXISTS public.establishment;
DROP TABLE IF EXISTS public.establishment_type;
DROP TABLE IF EXISTS public.domiciliary;
DROP TABLE IF EXISTS public.vehicle;
DROP TABLE IF EXISTS public.person;
DROP TABLE IF EXISTS public.user;
DROP TABLE IF EXISTS public.gender;
DROP TABLE IF EXISTS public.document_type;
DROP TABLE IF EXISTS public.account_status;
DROP TABLE IF EXISTS public.role_type;
DROP TABLE IF EXISTS public.state;
DROP TABLE IF EXISTS public.zone_type;
DROP TABLE IF EXISTS public.municipality;
DROP TABLE IF EXISTS public.department;
*/

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- Table: public.department

-- DROP TABLE IF EXISTS public.department;

CREATE TABLE IF NOT EXISTS public.department (
	id character(3) PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL
);

--INSERT INTO public.department (id, name) VALUES ('1', 'Antioquia');
INSERT INTO public.department (id, name) VALUES ('2', 'Nariño');
--INSERT INTO public.department (id, name) VALUES ('3', 'Valle Del Cauca');

SELECT * FROM public.department;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_department

DROP VIEW IF EXISTS view_department;

CREATE VIEW view_department AS
SELECT
	dp.id AS id,
	dp.name AS name
FROM public.department	dp
ORDER BY dp.id;

SELECT * FROM view_department;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.municipality

-- DROP TABLE IF EXISTS public.municipality;

CREATE TABLE IF NOT EXISTS public.municipality (
	id character(3) PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL,
	department_id character(3) NOT NULL REFERENCES department(id) ON DELETE CASCADE
);

/*
-- ANTIOQUIA
INSERT INTO public.municipality (id, name, department_id) VALUES ('1', 'Medellin', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('2', 'Caldas', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('3', 'Apartadó', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('4', 'Guatapé', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('5', 'Turbo', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('6', 'Envigado', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('7', 'Giraldo', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('8', 'Toledo', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('9', 'Sabanalarga', '1');
INSERT INTO public.municipality (id, name, department_id) VALUES ('10', 'Sabaneta', '1');
*/
/*
-- NARIÑO
INSERT INTO public.municipality (id, name, department_id) VALUES ('11', 'Pasto', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('12', 'Barbacoas', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('13', 'El Tambo', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('14', 'Funes', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('15', 'Guaitarilla', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('16', 'Ipiales', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('17', 'Magüí', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('18', 'Mosquera', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('19', 'Olaya Herrera', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('20', 'Francisco Pizarro', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('21', 'Ricaurte', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('22', 'Roberto Payán', '2');
INSERT INTO public.municipality (id, name, department_id) VALUES ('23', 'Túquerres', '2');*/
INSERT INTO public.municipality (id, name, department_id) VALUES ('24', 'Tumaco', '2');

/*
-- VALLE DEL CAUCA	
INSERT INTO public.municipality (id, name, department_id) VALUES ('25', 'Cali', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('26', 'Buenaventura', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('27', 'Yumbo', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('28', 'Tulúa', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('29', 'Palmira', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('30', 'Buga', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('31', 'Cartago', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('32', 'Florida', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('33', 'El cerrito', '3');
INSERT INTO public.municipality (id, name, department_id) VALUES ('34', 'Jamundí', '3');*/

SELECT * FROM public.municipality;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_municipality

DROP VIEW IF EXISTS view_municipality;

CREATE VIEW view_municipality AS
SELECT
	mt.id AS id,
	mt.name AS name,
	dp.name AS department
FROM public.municipality		mt
INNER JOIN public.department	dp ON dp.id=mt.department_id
ORDER BY mt.department_id;

SELECT * FROM view_municipality;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.zone_type

-- DROP TABLE IF EXISTS public.zone_type;

CREATE TABLE IF NOT EXISTS public.zone_type (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL
);

INSERT INTO public.zone_type (name) VALUES ('Urbana');
INSERT INTO public.zone_type (name) VALUES ('Rural');

SELECT * FROM public.zone_type;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_zone_type

DROP VIEW IF EXISTS view_zone_type;

CREATE VIEW view_zone_type AS
SELECT
	zt.id AS id,
	zt.name AS name
FROM public.zone_type zt
ORDER BY zt.id;

SELECT * FROM view_zone_type;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.state

-- DROP TABLE IF EXISTS public.state;

CREATE TABLE IF NOT EXISTS public.state (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL,
	color character varying(30) NOT NULL DEFAULT '#ffffff'
);

INSERT INTO public.state (name, color) VALUES ('Activado', '#b0d89a');
INSERT INTO public.state (name, color) VALUES ('Desactivado', '#f8bca4');

SELECT * FROM public.state;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_state

DROP VIEW IF EXISTS view_state;

CREATE VIEW view_state AS
SELECT
	st.id AS id, 
	st.name AS name, 
	st.color AS color
FROM public.state st
ORDER BY st.id;

SELECT * FROM view_state;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.role_type

-- DROP TABLE IF EXISTS public.role_type;

CREATE TABLE IF NOT EXISTS public.role_type (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL,
	color character varying(30) NOT NULL DEFAULT '#ffffff'
);

INSERT INTO public.role_type (name, color) VALUES ('Administrador', '#b0d89a');
INSERT INTO public.role_type (name, color) VALUES ('Establecimiento', '#f8bca4');
INSERT INTO public.role_type (name, color) VALUES ('Usuario', '#fff5a0');
INSERT INTO public.role_type (name, color) VALUES ('Domiciliario', '#c2e6e6');

SELECT * FROM public.role_type;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_role_type

DROP VIEW IF EXISTS view_role_type;

CREATE VIEW view_role_type AS
SELECT
	rt.id AS id, 
	rt.name AS name,
	rt.color AS color
FROM public.role_type rt
ORDER BY rt.id;

SELECT * FROM view_role_type;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.account_status

-- DROP TABLE IF EXISTS public.account_status;

CREATE TABLE IF NOT EXISTS public.account_status (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL,
	color character varying(30) NOT NULL DEFAULT '#ffffff'
);

INSERT INTO public.account_status (name, color) VALUES ('Activo', '#b0d89a');
INSERT INTO public.account_status (name, color) VALUES ('Bloqueado', '#f8bca4');

SELECT * FROM public.account_status;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_account_status

DROP VIEW IF EXISTS view_account_status;

CREATE VIEW view_account_status AS
SELECT
	ac.id AS id,
	ac.name AS name,
	ac.color AS color
FROM public.account_status ac
ORDER BY ac.id;

SELECT * FROM view_account_status;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.document_type

-- DROP TABLE IF EXISTS public.document_type;

CREATE TABLE IF NOT EXISTS public.document_type (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(60) NOT NULL,
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id) ON DELETE CASCADE,
	creation_date timestamp NOT NULL DEFAULT current_timestamp,
	modification_date timestamp NOT NULL DEFAULT current_timestamp,
	deletion_date timestamp NOT NULL DEFAULT current_timestamp,
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.document_type (name, state_id) VALUES ('CC', 1);
--INSERT INTO public.document_type (name, state_id) VALUES ('TI', 1);

SELECT * FROM public.document_type;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_document_type

DROP VIEW IF EXISTS view_document_type;

CREATE VIEW view_document_type AS
SELECT
	dt.id AS id,
	dt.name AS name
FROM public.document_type dt
WHERE dt.delete=false
ORDER BY dt.id;

SELECT * FROM view_document_type;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- Table: public.gender

-- DROP TABLE IF EXISTS public.gender;

CREATE TABLE IF NOT EXISTS public.gender (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL,
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id) ON DELETE CASCADE,
	creation_date timestamp NOT NULL DEFAULT current_timestamp,
	modification_date timestamp NOT NULL DEFAULT current_timestamp,
	deletion_date timestamp NOT NULL DEFAULT current_timestamp,
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.gender (name, state_id) VALUES ('M', 1);
INSERT INTO public.gender (name, state_id) VALUES ('F', 1);

SELECT * FROM public.gender;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_gender

DROP VIEW IF EXISTS view_gender;

CREATE VIEW view_gender AS
SELECT
	gd.id AS id,
	gd.name AS name
FROM public.gender gd
WHERE gd.delete=false
ORDER BY gd.id;

SELECT * FROM view_gender;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.user

-- DROP TABLE IF EXISTS public.user;

CREATE TABLE IF NOT EXISTS public.user (
	id bigserial PRIMARY KEY NOT NULL,
	image character varying(250) NULL DEFAULT 'default.svg',
	username character varying(30) NOT NULL,
	email_address character varying(30) NOT NULL,
	password character varying(200) NOT NULL,
	role_type_id smallint NOT NULL REFERENCES public.role_type(id),
	account_status_id smallint NOT NULL DEFAULT 1 REFERENCES public.account_status(id),
	creation_date timestamp NOT NULL DEFAULT current_timestamp,
	modification_date timestamp NOT NULL DEFAULT current_timestamp,
	deletion_date timestamp NOT NULL DEFAULT current_timestamp,
	delete boolean NOT NULL DEFAULT false
);

SELECT * FROM public.user;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_authentication_user

DROP VIEW IF EXISTS view_authentication_user;

CREATE VIEW view_authentication_user AS
SELECT
	us.id AS user_id,
	us.image,
	us.username,
	us.email_address,
	us.password,
	rt.name AS role_type,
	ac.name AS account_status
FROM public.user					us
INNER JOIN public.role_type			rt	ON rt.id=us.role_type_id
INNER JOIN public.account_status	ac	ON ac.id=us.account_status_id
WHERE us.delete=false
ORDER BY us.id;

SELECT * FROM view_authentication_user;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- View: view_user

DROP VIEW IF EXISTS view_user;

CREATE VIEW view_user AS
SELECT
	us.id AS user_id,
	us.image,
	us.username AS username,
	us.email_address AS email_address,
	rt.name AS role_type,
	rt.color AS role_type_color,
	ac.name AS account_status,
	ac.color AS account_status_color,
	(us.creation_date::DATE || ' ' || TO_CHAR(us.creation_date, 'HH24:MI')) AS creation_date--, 
	--(us.modification_date::DATE || ' ' || TO_CHAR(us.modification_date, 'HH24:MI')) AS modification_date
FROM public.user					us
INNER JOIN public.role_type			rt	ON rt.id=us.role_type_id
INNER JOIN public.account_status	ac	ON ac.id=us.account_status_id
WHERE us.delete=false
ORDER BY us.id;

SELECT * FROM view_user;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.person

-- DROP TABLE IF EXISTS public.person;

CREATE TABLE IF NOT EXISTS public.person (
	user_id bigint PRIMARY KEY NOT NULL REFERENCES public.user(id) ON DELETE CASCADE,
	first_name character varying(60) NOT NULL,
	last_name character varying(60) NOT NULL,
	date_of_birth date NOT NULL,
	gender_id smallint NOT NULL REFERENCES public.gender(id),
	document_type_id smallint NOT NULL REFERENCES public.document_type(id),
	document_number character varying(30) NOT NULL,
	phone_number character varying(10) NOT NULL,
	municipality_id character(3) NOT NULL REFERENCES public.municipality(id),
	zone_type_id smallint NOT NULL REFERENCES public.zone_type(id),
	address character varying(60) NOT NULL,
	person_rating integer NOT NULL DEFAULT 0 CHECK (person_rating >= 0)
);

-- Insertar datos utilizando la cláusula WITH
WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'jhon666', 'jhon666@prueba.test', md5(md5('12345')), 1
	) RETURNING id
) INSERT INTO public.person (
	user_id,
	first_name, last_name,
	date_of_birth, gender_id,
	document_type_id, document_number,
	phone_number,
	municipality_id,
	zone_type_id, address
) SELECT 
	id,
	'Jhon Fabio', 'España Cortes',
	'2000-1-1', 1, 
	1, '1234567890',
	'1234567890',
	24,
	1, 'Los balcones'
FROM inserted_user;

WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'guillermo777', 'guillermo777@prueba.test', md5(md5('12345')), 3
	) RETURNING id
) INSERT INTO public.person (
	user_id,
	first_name, last_name,
	date_of_birth, gender_id,
	document_type_id, document_number,
	phone_number,
	municipality_id,
	zone_type_id, address
) SELECT 
	id,
	'Jose Guillermo', 'Hurtado',
	'1999-1-1', 1, 
	1, '1234567891',
	'1234567891',
	24,
	1, 'Los balcones'
FROM inserted_user;

WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'fabio96', 'fabio69@prueba.test', md5(md5('12345')), 3
	) RETURNING id
) INSERT INTO public.person (
	user_id,
	first_name, last_name,
	date_of_birth, gender_id,
	document_type_id, document_number,
	phone_number,
	municipality_id,
	zone_type_id, address
) SELECT 
	id,
	'Fabio', 'Cortes',
	'1998-2-2', 1, 
	1, '1234567892',
	'1234567892',
	24,
	1, 'El morro'
FROM inserted_user;

SELECT * FROM public.person;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_person

DROP VIEW IF EXISTS view_person;

CREATE VIEW view_person AS
SELECT
	ps.user_id,
	us.image,
	ps.first_name,
	ps.last_name,
	ps.date_of_birth,
	date_part('year', age(ps.date_of_birth)) AS age,
	gd.name AS gender,
	dt.name AS document_type,
	ps.document_number,
	dp.name AS department,
	mt.name AS municipality,
	ps.address,
	zt.name AS zone_type,
	ps.phone_number,
	us.email_address,
	us.username,
	us.password
FROM public.person					ps
INNER JOIN public.user				us	ON us.id=ps.user_id
INNER JOIN public.document_type		dt	ON dt.id=ps.document_type_id
INNER JOIN public.gender			gd	ON gd.id=ps.gender_id
INNER JOIN public.municipality		mt	ON mt.id=ps.municipality_id
INNER JOIN public.department		dp	ON dp.id=mt.department_id
INNER JOIN public.zone_type			zt	ON zt.id=ps.zone_type_id
WHERE us.delete=false
ORDER BY ps.user_id;

SELECT * FROM view_person;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.vehicle

-- DROP TABLE IF EXISTS public.vehicle;

CREATE TABLE IF NOT EXISTS public.vehicle (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(60) NOT NULL,
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id),
	creation_date timestamp NOT NULL DEFAULT current_timestamp,
	modification_date timestamp NOT NULL DEFAULT current_timestamp,
	deletion_date timestamp NOT NULL DEFAULT current_timestamp,
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.vehicle (name, state_id) VALUES ('Moto', 1);
INSERT INTO public.vehicle (name, state_id) VALUES ('Carro', 1);
INSERT INTO public.vehicle (name, state_id) VALUES ('Lancha', 1);
INSERT INTO public.vehicle (name, state_id) VALUES ('Bus', 1);
INSERT INTO public.vehicle (name, state_id) VALUES ('Conbi', 1);
INSERT INTO public.vehicle (name, state_id) VALUES ('Bicicleta', 1);

SELECT * FROM public.vehicle;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_vehicle

DROP VIEW IF EXISTS view_vehicle;

CREATE VIEW view_vehicle AS
SELECT
	vh.id AS id, 
	vh.name AS name, 
	st.name AS state, 
	st.color AS state_color,
	(vh.creation_date::DATE || ' ' || TO_CHAR(vh.creation_date, 'HH24:MI')) AS creation_date, 
	(vh.modification_date::DATE || ' ' || TO_CHAR(vh.modification_date, 'HH24:MI')) AS modification_date
FROM public.vehicle			vh
INNER JOIN public.state		st	ON st.id = vh.state_id
WHERE vh.delete=false
ORDER BY vh.id;

SELECT * FROM view_vehicle;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.domiciliary

-- DROP TABLE IF EXISTS public.domiciliary;

/*CREATE TABLE IF NOT EXISTS public.domiciliary (
	id bigserial PRIMARY KEY NOT NULL, 
	person_id BIGINT not null REFERENCES public.person(id), 
	vehicle_id smallint not null references vehicle(id), 
	rating_domiciliary integer not null DEFAULT 0 check(rating_domiciliary >= 0), 
	accepted_date timestamp not null DEFAULT current_timestamp, 
	modification_date timestamp NOT NULL DEFAULT current_timestamp, 
	deletion_date timestamp NOT NULL DEFAULT current_timestamp, 
	state_id smallint not null DEFAULT 2 REFERENCES public.state(id), 
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.domiciliary (person_id, vehicle_id) VALUES (1, 1);

SELECT * FROM public.domiciliary;*/

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_domiciliary

--DROP VIEW IF EXISTS view_domiciliary;

--CREATE VIEW view_domiciliary AS
/*SELECT
	vus.id, 
	vus.username, 
	vus.image, 
	vus.role_type, 
	vh.name AS vehicle, 
	vus.rating AS person_rating, 
	dr.rating_domiciliary, 
	vus.account_status, 
	vus.first_name, 
	vus.last_name, 
	vus.document, 
	vus.age, 
	vus.date_of_birth, 
	vus.gender, 
	vus.phone_number, 
	vus.email_address, 
	vus.address, 
	vus.zone_type, 
	vus.department, 
	vus.municipality, 
	vus.creation_date, 
	vus.modification_date, 
	vus.deletion_date
FROM
	public.domiciliary	dr, 
	public.person			us, 
	view_person			vus, 
	public.vehicle		vh
WHERE
	us.id=dr.person_id and
	vus.role_type=UPPER('Domiciliario') and
	vh.id=dr.vehicle_id
ORDER BY dr.id;*/

--SELECT * FROM view_domiciliary;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.establishment_type

-- DROP TABLE IF EXISTS public.establishment_type;

CREATE TABLE IF NOT EXISTS public.establishment_type (
	id smallserial PRIMARY KEY NOT NULL,
	name character varying(30) NOT NULL,
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id),
	creation_date timestamp NOT NULL DEFAULT current_timestamp,
	modification_date timestamp NOT NULL DEFAULT current_timestamp,
	deletion_date timestamp NOT NULL DEFAULT current_timestamp,
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.establishment_type (name, state_id) VALUES ('Supermercado', 1);
INSERT INTO public.establishment_type (name, state_id) VALUES ('Drogueria', 1);
INSERT INTO public.establishment_type (name, state_id) VALUES ('Ferreteria', 2);
INSERT INTO public.establishment_type (name, state_id) VALUES ('Tienda', 2);

SELECT * FROM public.establishment_type;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_establishment_type

DROP VIEW IF EXISTS view_establishment_type;

CREATE VIEW view_establishment_type AS
SELECT
	et.id AS id,
	et.name AS name,
	st.name AS state,
	st.color AS state_color,
	(et.creation_date::DATE || ' ' || TO_CHAR(et.creation_date, 'HH24:MI')) AS creation_date, 
	(et.modification_date::DATE || ' ' || TO_CHAR(et.modification_date, 'HH24:MI')) AS modification_date
FROM public.establishment_type		et
INNER JOIN public.state				st	ON st.id = et.state_id
WHERE et.delete=false
ORDER BY et.id;

SELECT * FROM view_establishment_type;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.establishment

--DROP TABLE IF EXISTS public.establishment;

CREATE TABLE IF NOT EXISTS public.establishment (
	user_id bigint PRIMARY KEY NOT NULL REFERENCES public.user(id) ON DELETE CASCADE, 
	name character varying(60) NOT NULL, 
	municipality_id character(3) NOT NULL REFERENCES municipality(id), 
	zone_type_id smallint NOT NULL REFERENCES public.zone_type(id),
	address character varying(60) NOT NULL, 
	phone_number character varying(10) NOT NULL,
	establishment_type_id smallint NOT NULL REFERENCES establishment_type(id)
);

WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'mercaz', 'info@mercaz.com', md5(md5('12345')), 2
	) RETURNING id
) INSERT INTO public.establishment (
	user_id,
	name,
	municipality_id,
	zone_type_id,
	address,
	phone_number,
	establishment_type_id
) SELECT
	id,
	'Mercaz',
	24,
	1,
	'Calle Principal 123', 
	'3123456789',
	1
FROM inserted_user;

WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'd1', 'info@d1.com', md5(md5('12345')), 2
	) RETURNING id
) INSERT INTO public.establishment (
	user_id,
	name,
	municipality_id,
	zone_type_id,
	address,
	phone_number,
	establishment_type_id
) SELECT
	id,
	'D1',
	24,
	1,
	'Avenida Comercial 456', 
	'3109876543',
	1
FROM inserted_user;

WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'saludtotal', 'info@saludtotal.com', md5(md5('12345')), 2
	) RETURNING id
) INSERT INTO public.establishment (
	user_id,
	name,
	municipality_id,
	zone_type_id,
	address,
	phone_number,
	establishment_type_id
) SELECT
	id,
	'Salud Total',
	24,
	1,
	'Calle Principal 123', 
	'3112345678 ',
	2
FROM inserted_user;

WITH inserted_user AS (
	INSERT INTO public.user (
		username, email_address, password, role_type_id
	) VALUES (
		'elconstructor', 'info@elconstructor.com', md5(md5('12345')), 2
	) RETURNING id
) INSERT INTO public.establishment (
	user_id,
	name,
	municipality_id,
	zone_type_id,
	address,
	phone_number,
	establishment_type_id
) SELECT
	id,
	'El Constructor',
	24,
	1,
	'Avenida de los Materiales 321', 
	'3105576543 ',
	3
FROM inserted_user;

SELECT * FROM public.establishment;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_establishment

/*DROP VIEW IF EXISTS view_establishment;

CREATE VIEW view_establishment AS
SELECT
	es.user_id, 
	us.username, 
	es.image, 
	rt.name AS role_type, 
	ac.name AS account_status, 
	es.email_address, 
	es.address, 
	dp.name AS department, 
	mt.name AS municipality, 
	(us.creation_date::DATE || ' ' || TO_CHAR(us.creation_date, 'HH24:MI')) as creation_date, 
	(us.modification_date::DATE || ' ' || TO_CHAR(us.modification_date, 'HH24:MI')) as modification_date, 
	(us.deletion_date::DATE || ' ' || TO_CHAR(us.deletion_date, 'HH24:MI')) as deletion_date
FROM public.establishment				es
INNER JOIN public.user					us	ON us.id=es.user_id
INNER JOIN public.establishment_type	dt	ON dt.id=es.establishment_type_id
INNER JOIN public.municipality			mt	ON mt.id=es.municipality_id
INNER JOIN public.department			dp	ON dp.id=mt.department_id
INNER JOIN public.role_type				rt	ON rt.id=us.role_type_id
INNER JOIN public.account_status		ac	ON ac.id=us.account_status_id
WHERE us.delete=false AND UPPER(rt.name)=UPPER('ESTABLECIMIENTO')
ORDER BY es.user_id;

SELECT * FROM view_establishment;*/

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_establishment

DROP VIEW IF EXISTS view_establishment;

CREATE VIEW view_establishment AS
SELECT
	es.user_id,
	us.image,
	es.name,
	et.name AS establishment_type,
	--ps.last_name,
	--ps.date_of_birth,
	--date_part('year', age(ps.date_of_birth)) AS age,
	--gd.name AS gender,
	--dt.name AS document_type,
	--ps.document_number,
	dp.name AS department,
	mt.name AS municipality,
	es.address,
	zt.name AS zone_type,
	es.phone_number,
	us.email_address,
	us.username,
	us.password
FROM public.establishment				es
INNER JOIN public.user					us	ON us.id=es.user_id
INNER JOIN public.establishment_type	et	ON et.id=es.establishment_type_id
INNER JOIN public.municipality			mt	ON mt.id=es.municipality_id
INNER JOIN public.department			dp	ON dp.id=mt.department_id
INNER JOIN public.zone_type				zt	ON zt.id=es.zone_type_id
WHERE us.delete=false
ORDER BY es.user_id;

SELECT * FROM view_establishment;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.category

-- DROP TABLE IF EXISTS public.category;

CREATE TABLE IF NOT EXISTS public.category (
	id smallserial PRIMARY KEY NOT NULL, 
	name character varying(60) NOT NULL,
	establishment_id bigint NOT NULL REFERENCES establishment(user_id),
	creation_date timestamp NOT NULL DEFAULT current_timestamp, 
	modification_date timestamp NOT NULL DEFAULT current_timestamp, 
	deletion_date timestamp NOT NULL DEFAULT current_timestamp, 
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id), 
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.category (name, state_id,  establishment_id) VALUES ('Alimentos Frescos', 1, 5);
INSERT INTO public.category (name, state_id,  establishment_id) VALUES ('Cuidado Personal', 1, 5);
INSERT INTO public.category (name, state_id,  establishment_id) VALUES ('Limpieza del Hogar', 1, 5);
INSERT INTO public.category (name, state_id,  establishment_id) VALUES ('Electrodomésticos', 1, 5);
INSERT INTO public.category (name, state_id,  establishment_id) VALUES ('Bebidas y Snacks', 1, 5);

SELECT * FROM public.category;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_category

DROP VIEW IF EXISTS view_category;

CREATE VIEW view_category AS
SELECT
	cr.id AS id, 
	cr.name AS name, 
	cr.establishment_id AS establishment,
	st.name AS state,
	st.color AS state_color,
	(cr.creation_date::DATE || ' ' || TO_CHAR(cr.creation_date, 'HH24:MI')) AS creation_date, 
	(cr.modification_date::DATE || ' ' || TO_CHAR(cr.modification_date, 'HH24:MI')) AS modification_date
FROM public.category				cr
INNER JOIN public.state				st	ON st.id = cr.state_id
INNER JOIN public.establishment		es	ON es.user_id = cr.establishment_id
WHERE cr.delete=false
ORDER BY cr.id;

SELECT * FROM view_category;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.brand

-- DROP TABLE IF EXISTS public.brand;

CREATE TABLE IF NOT EXISTS public.brand (
	id smallserial PRIMARY KEY NOT NULL, 
	name character varying(60) NOT NULL,
	establishment_id bigint NOT NULL REFERENCES establishment(user_id),
	creation_date timestamp NOT NULL DEFAULT current_timestamp, 
	modification_date timestamp NOT NULL DEFAULT current_timestamp, 
	deletion_date timestamp NOT NULL DEFAULT current_timestamp, 
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id), 
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Fresh Farms', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Oceanic Delights', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Dairy Goodness', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Green Fields Organics', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Whole Grain Delights', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Farm Fresh Poultry', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Greek Delights', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Organic Harvest', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Sweet Vineyards', 1, 5);
INSERT INTO public.brand (name, state_id,  establishment_id) VALUES ('Cheesy Delights', 1, 5);

SELECT * FROM public.brand;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_brand

DROP VIEW IF EXISTS view_brand;

CREATE VIEW view_brand AS
SELECT
	bd.id AS id, 
	bd.name AS name, 
	bd.establishment_id AS establishment,
	st.name AS state,
	st.color AS state_color,
	(bd.creation_date::DATE || ' ' || TO_CHAR(bd.creation_date, 'HH24:MI')) AS creation_date, 
	(bd.modification_date::DATE || ' ' || TO_CHAR(bd.modification_date, 'HH24:MI')) AS modification_date
FROM public.brand					bd
INNER JOIN public.state				st	ON st.id = bd.state_id
INNER JOIN public.establishment		es	ON es.user_id = bd.establishment_id
WHERE bd.delete=false
ORDER BY bd.id;

SELECT * FROM view_brand;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- Table: public.product

-- DROP TABLE IF EXISTS public.product;

CREATE TABLE IF NOT EXISTS public.product (
	id bigserial PRIMARY KEY NOT NULL,
	name character varying(60) NOT NULL,
	brand_id bigint NOT NULL REFERENCES public.brand(id),
	price numeric(10, 2) NOT NULL DEFAULT 0 CHECK (price >= 0::numeric),
	quantity integer NOT NULL DEFAULT 0 CHECK (quantity >= 0),
	barcode character varying(13) NOT NULL,
	category_id smallint NOT NULL REFERENCES public.category(id),
	section character varying(60) NOT NULL,
	image character varying(250) NULL DEFAULT 'default.svg',
	establishment_id bigint NOT NULL REFERENCES establishment(user_id) ON DELETE CASCADE,
	description text NOT NULL DEFAULT '-',
	state_id smallint NOT NULL DEFAULT 2 REFERENCES public.state(id),
	creation_date timestamp NOT NULL DEFAULT current_timestamp,
	modification_date timestamp NOT NULL DEFAULT current_timestamp,
	deletion_date timestamp NOT NULL DEFAULT current_timestamp,
	delete boolean NOT NULL DEFAULT false
);

/*
INSERT INTO public.product (
	name, brand_id, price, quantity,
	barcode, category_id, section, establishment_id,
	state_id
) VALUES (
	'Manzana', 1, 3000, 100, 
	'1111111111111', 1, UPPER('A1'), 4, 1
);
*/

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Manzana', 1, 3000, 100,
'1111111111111', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Plátano', 2, 2500, 80,
'2222222222222', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Sandía', 3, 5000, 60,
'3333333333333', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Lechuga', 4, 1500, 120,
'4444444444444', 1, 'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Tomate', 5, 2200, 90,
'5555555555555', 1, 'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Fresas', 6, 2800, 70,
'6666666666666', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Naranja', 7, 1800, 110,
'7777777777777', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Pera', 8, 3200, 95,
'8888888888888', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Papaya', 9, 3500, 75,
'9999999999999', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Piña', 10, 2800, 85,
'1010101010101', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Manzana Verde', 1, 3200, 95,
'1111111111112', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Uvas', 1, 3800, 65,
'1212121212121', 1, 'Frutas', 5, 1
);

---

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Cebolla', 1, 1200, 140,
'1313131313131', 1,'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Zanahoria', 2, 1500, 110,
'1414141414141', 1, 'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Papa', 3, 900, 200,
'1515151515151', 1, 'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Aguacate', 4, 2500, 90,
'1616161616161', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Mango', 5, 3000, 80,
'1717171717171', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Melón', 6, 3500, 70,
'1818181818181', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Limón', 7, 1800, 120,
'1919191919191', 1, 'Frutas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Pepino', 8, 1300, 150,
'2020202020202', 1, 'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Pimentón', 9, 2000, 100,
'2121212121212', 1, 'Verduras', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Espárragos', 10, 4500, 50,
'2222222222222', 1, 'Verduras', 5, 1
);

---

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Frijoles', 2, 2200, 90,
'2323232323232', 1, 'Legumbres', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Lentejas', 3, 1800, 110,
'2424242424242', 1, 'Legumbres', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Garbanzos', 3, 2000, 100,
'2525252525252', 1, 'Legumbres', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Cilantro', 4, 700, 180,
'2626262626262', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Perejil', 1, 800, 160,
'2727272727272', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Albahaca', 2, 900, 140,
'2828282828282', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Cebollín', 1, 700, 180,
'2929292929292', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Hierbabuena', 1, 800, 160,
'3030303030303', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Tomillo', 5, 900, 140,
'3131313131313', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Romero', 6, 700, 180,
'3232323232323', 1, 'Hierbas', 5, 1
);

---

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Orégano', 8, 800, 160,
'3333333333333', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Melissa', 2, 900, 140,
'3434343434343', 1, 'Hierbas', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Jengibre', 3, 2500, 90,
'3535353535353', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Canela', 5, 1800, 120,
'3636363636363', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Curry', 8, 2000, 100,
'3737373737373', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Pimienta', 9, 1200, 140,
'3838383838383', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Nuez Moscada', 2, 1500, 110,
'3939393939393', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Sal', 4, 900, 180,
'4040404040404', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Azúcar', 2, 800, 190,
'4141414141414', 1, 'Especias', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Vinagre', 1, 1000, 170,
'4242424242424', 1, 'Condimentos', 5, 1
);

---

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Aceite de Oliva', 4, 3500, 80,
'4343434343434', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Mayonesa', 3, 2000, 110,
'4444444444444', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Mostaza', 4, 1800, 120,
'4545454545454', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Salsa de Soja', 2, 1500, 140,
'4646464646464', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Salsa de Tomate', 1, 1200, 170,
'4747474747474', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Ketchup', 5, 1000, 190,
'4848484848484', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Miel', 5, 2500, 90,
'4949494949494', 1, 'Condimentos', 5, 1
);

INSERT INTO public.product (
name, brand_id, price, quantity, barcode, category_id,
section, establishment_id, state_id
) VALUES (
'Salsa BBQ', 2, 1800, 120,
'5050505050505', 1, 'Condimentos', 5, 1
);

---

SELECT * FROM public.product;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: view_product

DROP VIEW IF EXISTS view_product;

CREATE VIEW view_product AS
SELECT
	pd.id,
	pd.image,
	pd.name,
	pd.barcode,
	pd.price,
	pd.quantity,
	pd.establishment_id AS establishment,
	cr.name AS category,
	bd.name AS brand,
	pd.section,
	pd.description,
	st.name AS state,
	st.color AS state_color,
	(pd.creation_date::DATE || ' ' || TO_CHAR(pd.creation_date, 'HH24:MI')) AS creation_date, 
	(pd.modification_date::DATE || ' ' || TO_CHAR(pd.modification_date, 'HH24:MI')) AS modification_date
FROM public.product					pd
INNER JOIN public.category			cr	ON cr.id = pd.category_id
INNER JOIN public.brand				bd	ON bd.id = pd.brand_id
INNER JOIN public.state				st	ON st.id = pd.state_id
INNER JOIN public.establishment		es	ON es.user_id = pd.establishment_id
WHERE pd.delete=false
ORDER BY pd.establishment_id;

SELECT * FROM view_product;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

-- View: view_product_card

DROP VIEW IF EXISTS view_product_card;

CREATE VIEW view_product_card AS
SELECT
	pd.id,
	pd.image,
	pd.name,
	--pd.barcode,
	pd.price,
	pd.quantity,
	es.name AS establishment,
	cr.name AS category,
	bd.name AS brand,
	--pd.section,
	--pd.description,
	st.name AS state,
	us.delete--,
	--st.color AS state_color,
	--(pd.creation_date::DATE || ' ' || TO_CHAR(pd.creation_date, 'HH24:MI')) AS creation_date, 
	--(pd.modification_date::DATE || ' ' || TO_CHAR(pd.modification_date, 'HH24:MI')) AS modification_date
FROM public.product					pd
INNER JOIN public.category			cr	ON cr.id = pd.category_id
INNER JOIN public.brand				bd	ON bd.id = pd.brand_id
INNER JOIN public.state				st	ON st.id = pd.state_id
INNER JOIN public.establishment		es	ON es.user_id = pd.establishment_id
INNER JOIN public.user				us	ON es.user_id = us.id
WHERE pd.delete=false AND UPPER(st.name)=UPPER('Activado') AND us.delete=false
ORDER BY pd.establishment_id;

SELECT * FROM view_product_card;

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 


-- Table: public.list

-- DROP TABLE IF EXISTS public.list;

/*CREATE TABLE IF NOT EXISTS public.list (
	id bigserial PRIMARY KEY NOT NULL, 
	name character varying(60) NOT NULL, 
	description text NOT NULL DEFAULT '', 
	person_id bigint NOT NULL REFERENCES public.person(id), 
	product_id bigint NOT NULL REFERENCES public.product(id), 
	quantity integer NOT NULL DEFAULT 0 CHECK (quantity >= 0), 
	creation_date timestamp NOT NULL DEFAULT current_timestamp, 
	modification_date timestamp NOT NULL DEFAULT current_timestamp, 
	deletion_date timestamp NOT NULL DEFAULT current_timestamp, 
	state_id smallint NOT NULL DEFAULT 1 REFERENCES public.state(id), 
	delete boolean NOT NULL DEFAULT false
);

INSERT INTO public.list (
	name, person_id, product_id
) VALUES (
	'Manzana', 1, 1
);

SELECT * FROM public.list;*/

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
