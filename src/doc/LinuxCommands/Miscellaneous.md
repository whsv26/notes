# Misc

- #### Set ACL
  ```console
  whsv26@whsv26:~$ setfacl -R -m u:$USER:rwx $DIRECTORY_PATH
  ```

- #### Print all locks
  ```console
  whsv26@whsv26:~$ lslocks
  ```

- #### Find file
  ```console
  whsv26@whsv26:~$ find $FROM_PATH -name "file*.php" 
  ```

- #### Where the f*ck is it placed
  ```console
  whsv26@whsv26:~$ readlink -f $SYMLINK
  ```

- #### Executable finding
  ```console
  whsv26@whsv26:~$ whereis
  whsv26@whsv26:~$ which
  ```

- #### Compile GraphQL schema to html 
  [@dependency](https://github.com/2fd/graphdoc)
  ```console
  whsv26@whsv26:~$ SCHEMA="schema.graphql" && DIR="doc/schema" 
  whsv26@whsv26:~$ graphdoc -s $SCHEMA -o $DIR
  ```
