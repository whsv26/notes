# Databases

#### MySQL

- Dump with condition
  ```console
  whsv26@whsv26:~$ mysqldump --skip-lock-tables -P$PORT -h$HOST -u$USER -p$PASSWORD $DATABASE $TABLE --where="condition" | gzip > backup.sql.gz
  ```

- Dump without exposed credentials
  ```console
  whsv26@whsv26:~$ mysqldump --login-path=local --skip-lock-tables $DATABASE | gzip > backup.sql.gz
  ``` 

- Reload configs ```sudo /etc/init.d/mysql reload```
