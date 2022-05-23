#!/bin/ash
set -e

# https://github.com/sudo-bmitch/jenkins-docker/blob/master/entrypoint.sh
# see https://github.com/thecodingmachine/docker-images-php/pull/139/files
chown $UID:82 /proc/self/fd/1 /proc/self/fd/2

if [ "$(id -u)" = "0" ]; then
  # explicit exit
  if [[ -z "$UID" ]]; then
    echo "\$UID env variable not set, exiting with code 4"
    exit 4
  fi

  # shellcheck disable=SC2039
  usermod -u "$UID" www-data

  # Add call to su-exec to drop from root user to www-data user
  # when running original entrypoint
  set -- su-exec www-data "$@"
fi

exec "$@"
