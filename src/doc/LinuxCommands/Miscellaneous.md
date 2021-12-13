# Misc

- #### Set ACL
  ```console
  setfacl -R -m u:$USER:rwx $DIRECTORY_PATH
  ```

- #### Print all locks
  ```console
  lslocks
  ```

- #### Find file
  ```console
  find $FROM_PATH -name "file*.php" 
  ```

- #### Where the f*ck is it placed
  ```console
  readlink -f $SYMLINK
  ```

- #### Executable finding
  ```console
  whereis
  which
  ```

- #### Compile GraphQL schema to html 
  [@dependency](https://github.com/2fd/graphdoc)
  ```console
  SCHEMA="schema.graphql" && DIR="doc/schema" 
  graphdoc -s $SCHEMA -o $DIR
  ```
