# Process

- #### Print process tree
  ```console
  print process tree
  pstree -p
  ps -ejH
  ```

- #### Watch processes by pattern
  ```console
  watch 'ps faux | grep $PATTERN'
  ```

- #### Detailed process RAM usage
  ```console
  sudo pmap $PID
  ```
