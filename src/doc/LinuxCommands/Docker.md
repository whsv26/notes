# Docker

- #### Kill all running containers 
  ```console
  docker kill $(docker ps -q) 
  ```

- #### Import to mysql container with progress bar
  ```console
  pv ./dump.sql.gz | gunzip | docker exec -i $CONTAINER_NAME mysql -u$USERNAME -p$PASSWORD --database $DATABASE 
  ```

- #### Psalm language server from docker container 
  ```console
  docker-compose exec -T $SERVICE_NAME ./vendor/bin/psalm-language-server 
  ```
