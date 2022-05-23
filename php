#!/usr/bin/env bash

if [[ ! -z "$@" ]]
then
  bash ./exec -c zbbg.php "$@"
else
  bash ./exec -c zbbg.php sh
fi
