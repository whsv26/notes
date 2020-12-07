# Filesystem

- List filesystems
```
list filesystems
lsblk 
fdisk -l
```

- Mounting
```
unmount
umount /dev/sd<?>
```

- ISO to flash drive
```
dd bs=4M if=<iso> of=/dev/sd<?> conv=fdatasync status=progress
```

- Formatting drive
  ```
  mkfs.(bfs|cramfs|ext2|ext3|ext4|f22fs|fat|minix|msdos|ntfs|vfat) /dev/sdb
  ```

  _Example formatting usb drive_
    - Find out whick filesystem your drive mounted on: `df -h | grep <usb-name>`
    
      _Output_: `/dev/sdb1 - - - /media/<user>/<usb-name>`
    - Unmount it: `umount /dev/sdb1`
    - Format the drive: `mkfs.ext4 /dev/sdb1`

# Package management
- Full delete
```
apt --purge remove "package-name*"
apt autoremove
apt autoclean
```

- Search package ```apt search <package>```

# OS
- Full system info ```dmidecode```
- CPU info ```lscpu```
- RAM info ```dmidecode --type memory | less```
- Running services ```service --status-all```
- Show systemd logs ```journalctl```
- Find out whick filesystem your drive mounted on
    ```
    df -h | grep <usb-name>
    ```
    Output is:
    ```
    /dev/sdb1 ... ... ... /media/<user>/<usb-name>
    ```
    - Unmount it
    ```
    umount /dev/sdb1
    ```
    - Format the drive
    ```
    mkfs.ext4 /dev/sdb1
    ```
# Process

```
print process tree
pstree -p
ps -ejH
```

# SSL
- renew particular cert 
```
certbot renew --dry-run --cert-name <cert_name>
```
- renew all certs and restart nginx 
```
certbot renew --post-hook "systemctl restart nginx"
```

# Docker
- Kill all running containers
```
docker kill $(docker ps -q)
```
- Import to mysql container with progress bar
```
pv ./dump.sql.gz | gunzip | \
docker exec -i <container_name> mysql -u<username> -p<password> --database <database>
```
- Psalm language server from docker container
```
docker-compose -f ./docker-compose.yml exec -T <service-name> ./vendor/bin/psalm-language-server
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
```
scp -P<port> <user>@<host>:<remote_path> <local_path>
```
- Open ssh-tunnel
```
ssh -p <ssh-port> -i ~/.ssh/<private_key> -N \ 
-L <local-port>:<remote-ip>:<remote-port> \
<ssh-user>@<ssh-server-ip>
```

# Databases

#### MySQL

- Dump with condition
```
mysqldump --skip-lock-tables -P<port> -h<host> -u<user> -p<password> <database> <table> --where="condition" | gzip > backup.sql.gz
```

- Dump without exposed credentials
```
mysqldump --login-path=local --skip-lock-tables <database> | gzip > backup.sql.gz
``` 

- Reload configs ```sudo /etc/init.d/mysql reload```

# Misc

- Set ACL ```setfacl -R -m u:<user>:rwx <directory_path>```
- Print all locks ```lslocks```
- Find file ```find <from_path> -name "file*.php"```
- Where de f*ck is it placed ```readlink -f <symlink>```
- Что где когда ```whereis``` ```which```
