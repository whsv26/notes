# Network

- #### Check DNS text record
  ```console
  dig
  ```

- #### Scan ports
  ```console
  nmap -A -Pn $IP
  ```

- #### Check port
  ```console
  nmap -vv -Pn -p $PORT $IP
  ```

- #### Show local ports
  ```console
  sudo netstat -tulpn
  ```

- #### Resolve host ip and mail exchanger
  ```console
  host $HOST
  ```
