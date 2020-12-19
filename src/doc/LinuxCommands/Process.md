# Process

- #### Print process tree
  ```console
  whsv26@whsv26:~$ print process tree
  whsv26@whsv26:~$ pstree -p
  whsv26@whsv26:~$ ps -ejH
  ```

- #### Watch processes by pattern
  ```console
  whsv26@whsv26:~$ watch 'ps faux | grep $PATTERN'
  ```

- #### Detailed process RAM usage
  ```console
  whsv26@whsv26:~$ sudo pmap $PID
  ```
