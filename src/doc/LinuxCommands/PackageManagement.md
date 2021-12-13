# Package management

- #### Set alternative version
  ```console
  sudo update-alternatives --config php
  ```

- #### Full delete
  ```console
  PACKAGE="package-name"
  apt --purge remove "$PACKAGE*"
  apt autoremove
  apt autoclean
  ```

- #### Search package
  ```console
  apt search $PACKAGEapt search $PACKAGE
  ```
