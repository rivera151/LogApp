\i setVars.psql

\c :dbName;

revoke all on users from :appUser;

drop table if exists users;

\c postgres;

drop database if exists :dbName;

drop user if exists :appUser;

\i unsetVars.psql;

