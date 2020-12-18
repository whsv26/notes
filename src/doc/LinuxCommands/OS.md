# OS
- Full system info ```dmidecode```
- CPU info ```lscpu```
- RAM info ```dmidecode --type memory | less```
- Running services ```service --status-all```
- Show systemd logs ```journalctl```


- Identify a kernel [@see](https://ubuntu.com/kernel)
  ```console 
    whsv26@whsv26:~$ cat /proc/version_signature
  ``` 
