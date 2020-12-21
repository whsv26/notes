# Package management

- #### Set alternative version
  ```console
  whsv26@whsv26:~$ sudo update-alternatives --config php
  ```

- #### Full delete
  ```console
  whsv26@whsv26:~$ PACKAGE="package-name"
  whsv26@whsv26:~$ apt --purge remove "$PACKAGE*"
  whsv26@whsv26:~$ apt autoremove
  whsv26@whsv26:~$ apt autoclean
  ```

- #### Search package
  ```console
  whsv26@whsv26:~$ apt search $PACKAGEapt search $PACKAGE
  ```
