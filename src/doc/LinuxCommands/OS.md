# OS

- #### Full system info
  ```console 
    whsv26@whsv26:~$ dmidecode
  ``` 

- #### CPU info
  ```console 
    whsv26@whsv26:~$ lscpu
  ``` 

- #### RAM info
  ```console 
    whsv26@whsv26:~$ dmidecode --type memory | less
  ``` 

- #### Running services
  ```console 
    whsv26@whsv26:~$ service --status-all
  ``` 

- #### Show systemd logs
  ```console 
    whsv26@whsv26:~$ journalctl
  ``` 

- #### Identify a kernel 
  [@see](https://ubuntu.com/kernel)
  ```console 
    whsv26@whsv26:~$ cat /proc/version_signature
  ``` 
