# Network

- #### Check DNS text record
  ```console
  whsv26@whsv26:~$ dig
  ```

- #### Scan ports
  ```console
  whsv26@whsv26:~$ nmap -A -Pn $IP
  ```

- #### Check port
  ```console
  whsv26@whsv26:~$ nmap -vv -Pn -p $PORT $IP
  ```

- #### Show local ports
  ```console
  whsv26@whsv26:~$ sudo netstat -tulpn
  ```

- #### Resolve host ip and mail exchanger
  ```console
  whsv26@whsv26:~$ host $HOST
  ```
