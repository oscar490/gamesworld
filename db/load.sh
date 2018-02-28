#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))
if [ "$1" != "test" ]
then
    psql -h localhost -U gamesworld -d gamesworld < $BASE_DIR/gamesworld.sql
fi
psql -h localhost -U gamesworld -d gamesworld_test < $BASE_DIR/gamesworld.sql
