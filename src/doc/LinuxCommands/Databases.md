# Databases

## MySQL

- #### Dump with condition
  ```console
  mysqldump --skip-lock-tables -P$PORT -h$HOST -u$USER -p$PASSWORD $DATABASE $TABLE --where="condition" | gzip > backup.sql.gz
  ```

- #### Dump without exposed credentials
  ```console
  mysqldump --login-path=local --skip-lock-tables $DATABASE | gzip > backup.sql.gz
  ```

- #### Reload configs
  ```console
  sudo /etc/init.d/mysql reload
  ```

- #### Import a table from DB dump
  ```console
  sed -n -e '/DROP TABLE.*`mytable`/,/UNLOCK TABLES/p' mydump.sql > tabledump.sql
  ```

- #### Migrate from MySQL to PostgreSQL
  ```console
  pgloader mysql://$USERNAME:$PASSWORD@$HOST:$PORT/$DATABASE postgresql://$USERNAME:$PASSWORD@$HOST:$PORT/$DATABASE
  ```
  

