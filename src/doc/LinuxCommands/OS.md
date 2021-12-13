# OS

- #### Full system info
  ```console 
  dmidecode
  ``` 

- #### CPU info
  ```console 
  lscpu
  ``` 

- #### RAM info
  ```console 
  dmidecode --type memory | less
  ``` 

- #### Running services
  ```console 
  service --status-all
  ``` 

- #### Show systemd logs
  ```console 
  journalctl
  ``` 

- #### Identify a kernel 
  [@see](https://ubuntu.com/kernel)
  ```console 
  cat /proc/version_signature
  ``` 
