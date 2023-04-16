#!/bin/bash

mysqldump --no-data gorillareport clients > estructura_clients.sql
mysqldump --ignore-table=gorillareport.clients gorillareport > datos_sin_tabla_client.sql
cat estructura_client.sql datos_sin_tabla_client.sql > copia_completa.sql
