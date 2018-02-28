#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE gamesworld_test;"
    psql -U postgres -c "CREATE USER gamesworld PASSWORD 'gamesworld' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists gamesworld
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists gamesworld_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists gamesworld
    sudo -u postgres psql -c "CREATE USER gamesworld PASSWORD 'gamesworld' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O gamesworld gamesworld
    sudo -u postgres createdb -O gamesworld gamesworld_test
    LINE="localhost:5432:*:gamesworld:gamesworld"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
