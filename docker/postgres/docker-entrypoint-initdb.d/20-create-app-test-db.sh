#!/usr/bin/env bash

set -eo pipefail

. /usr/local/bin/common-functions.sh

if [[ -z "${app_test_db}" ]] ; then
  return 0
fi

readarray -td" " test_databases <<<"$app_test_db"

for test_database in "${test_databases[@]}"
do
  psql -v ON_ERROR_STOP=1 \
      --dbname "$db" \
      --username="$user" <<-EOSQL
      CREATE DATABASE ${test_database} OWNER ${app_test_user};
EOSQL
done


