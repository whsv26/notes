# Filesystem

- List character devices
  ```console
  whsv26@whsv26:~$ sed -n '/^Character/, /^$/ { /^$/ !p }' /proc/devices
  ```

- List block devices
  ```console
  whsv26@whsv26:~$ sed -n '/^Block/, /^$/ { /^$/ !p }' /proc/devices
  ```

- List block devices in tree format with disk/part separation
  ```console
  whsv26@whsv26:~$ list lsblk
  ```
  
- List filesystems
  ```console
  whsv26@whsv26:~$ list filesystems
  whsv26@whsv26:~$ sudo fdisk -l
  ```

- Mounting
  ```console
  whsv26@whsv26:~$ DEVICE="/dev/sdb"
  whsv26@whsv26:~$ unmount $DEVICE
  ```

- ISO to flash drive
  ```console
  whsv26@whsv26:~$ ISO="ubuntu.iso" && DEVICE="/dev/sdb"
  whsv26@whsv26:~$ dd bs=4M if=$ISO of=$DEVICE conv=fdatasync status=progress
  ```

- Formatting drive
  ```console
  whsv26@whsv26:~$ FS="bfs|cramfs|ext2|ext3|ext4|f22fs|fat|minix|msdos|ntfs|vfat"
  whsv26@whsv26:~$ mkfs.$FS /dev/sdb
  ```
- Format USB drive
  ```console
  whsv26@whsv26:~$ USB="/dev/sdb1"
  whsv26@whsv26:~$ df -h | grep $USB
  /dev/sdb1 - - - /media/<user>/$USB
  whsv26@whsv26:~$ umount /dev/sdb1
  whsv26@whsv26:~$ mkfs.ext4 /dev/sdb1
  ```

# Package management
- Full delete
  ```console
  whsv26@whsv26:~$ apt --purge remove "package-name*"
  whsv26@whsv26:~$ apt autoremove
  whsv26@whsv26:~$ apt autoclean
  ```

- Search package ```apt search <package>```

# OS
- Full system info ```dmidecode```
- CPU info ```lscpu```
- RAM info ```dmidecode --type memory | less```
- Running services ```service --status-all```
- Show systemd logs ```journalctl```

# Process

```console
whsv26@whsv26:~$ print process tree
whsv26@whsv26:~$ pstree -p
whsv26@whsv26:~$ ps -ejH
```

# SSL
- renew particular cert 
  ```console
  whsv26@whsv26:~$ certbot renew --dry-run --cert-name <cert_name>
  ```

- renew all certs and restart nginx 
  ```console
  whsv26@whsv26:~$ certbot renew --post-hook "systemctl restart nginx"
  ```

# Docker
- Kill all running containers
  ```console
  whsv26@whsv26:~$ docker kill $(docker ps -q)
  ```

- Import to mysql container with progress bar
  ```console
  whsv26@whsv26:~$ pv ./dump.sql.gz | gunzip | \
  docker exec -i <container_name> mysql -u<username> -p<password> --database <database>
  ```

- Psalm language server from docker container
  ```console
  whsv26@whsv26:~$ docker-compose exec -T <service-name> ./vendor/bin/psalm-language-server
  ```

# Network

- Check DNS text record ```dig```
- Scan ports ```nmap -A -Pn <ip>```
- Check port ```nmap -vv -Pn -p <port> <ip>```
- Show local ports ```sudo netstat -tulpn```
- Resolve host ip and mail exchanger ```host <host>```

# Archives
- Compress folder ```tar -zcf <archive_name.tar.gz> <folder>```
- Decompress folder ```tar -zxf <archive_name.tar.gz>```
- Decompress to stdout ```gzip -dc <archive_name.gz>```

# SSH
- Copy remote file
  ```console
  whsv26@whsv26:~$ scp -P<port> <user>@<host>:<remote_path> <local_path>
  ```

- Open ssh-tunnel
  ```console
  whsv26@whsv26:~$ ssh -p <ssh-port> -i ~/.ssh/<private_key> -N \ 
  -L <local-port>:<remote-ip>:<remote-port> \
  <ssh-user>@<ssh-server-ip>
  ```

# Databases

#### MySQL

- Dump with condition
  ```console
  whsv26@whsv26:~$ mysqldump --skip-lock-tables -P<port> -h<host> -u<user> -p<password> <database> <table> --where="condition" | gzip > backup.sql.gz
  ```

- Dump without exposed credentials
  ```console
  whsv26@whsv26:~$ mysqldump --login-path=local --skip-lock-tables <database> | gzip > backup.sql.gz
  ``` 

- Reload configs ```sudo /etc/init.d/mysql reload```

# Misc

- Set ACL ```setfacl -R -m u:<user>:rwx <directory_path>```
- Print all locks ```lslocks```
- Find file ```find <from_path> -name "file*.php"```
- Where the f*ck is it placed ```readlink -f <symlink>```
- Что где когда ```whereis``` ```which```
