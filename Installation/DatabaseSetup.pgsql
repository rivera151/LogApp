\i setVars.psql

create user :appUser with password ':dbPW';

create database :dbName;

-- PostgreSQL specific syntax to connect to database
\c :dbName;

create table users (
	id serial,
	email varchar not null,
	role integer not null default 1
);

grant select on users to :appUser;

\i loadSampleData.psql;

\i unsetVars.psql;


