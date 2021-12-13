# Docker

- #### Show containers logs size
  ```console
  sudo sh -c "du -ch /var/lib/docker/containers/*/*-json.log" 
  ```

- #### Clean all container logs
  ```console
  sudo sh -c "truncate -s 0 /var/lib/docker/containers/*/*-json.log" 
  ```

- #### Update all images to the latest version
  ```console
  docker images --format "{{.Repository}}:{{.Tag}}" | grep --invert-match '<none>' | xargs -L1 docker pull
  ```

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
