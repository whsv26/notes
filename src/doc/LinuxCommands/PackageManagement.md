# Package management
- #### Full delete
  ```console
  whsv26@whsv26:~$ PACKAGE="package-name"
  whsv26@whsv26:~$ apt --purge remove "$PACKAGE*"
  whsv26@whsv26:~$ apt autoremove
  whsv26@whsv26:~$ apt autoclean
  ```

- #### Search package ```apt search $PACKAGE```
