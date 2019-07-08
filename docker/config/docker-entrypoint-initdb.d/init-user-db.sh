#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
	CREATE USER user_api PASSWORD '4p1c4str0db';
	CREATE DATABASE cer_apidb WITH OWNER user_api;
	GRANT ALL PRIVILEGES ON \\ cer_apidb TO user_api;
EOSQL