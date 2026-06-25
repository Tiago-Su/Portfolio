#!/bin/bash
set -e

DB="../private/database/database.db"

if [ ! -f "$DB" ]; then
    mkdir -p ../private/database/sql
    sqlite3 "$DB" < ../private/database/sql/database.sql
    sqlite3 "$DB" < ../private/database/sql/population.sql
    echo "Database created."
fi

php -S localhost:9000
