# LinuxCommands
**Contents**
- [Archives](#Archives)
  - [Compress folder](#Compress-folder)
  - [Decompress folder](#Decompress-folder)
  - [Decompress to stdout](#Decompress-to-stdout)
- [Databases](#Databases)
  - [Dump with condition](#Dump-with-condition)
  - [Dump without exposed credentials](#Dump-without-exposed-credentials)
  - [Reload configs](#Reload-configs)
  - [Import a table from DB dump](#Import-a-table-from-DB-dump)
  - [Migrate from MySQL to PostgreSQL](#Migrate-from-MySQL-to-PostgreSQL)
- [Docker](#Docker)
  - [Kill all running containers](#Kill-all-running-containers)
  - [Import to mysql container with progress bar](#Import-to-mysql-container-with-progress-bar)
  - [Psalm language server from docker container](#Psalm-language-server-from-docker-container)
- [Filesystem](#Filesystem)
  - [List character devices](#List-character-devices)
  - [List block devices](#List-block-devices)
  - [List block devices in tree format with disk and part separation](#List-block-devices-in-tree-format-with-disk-and-part-separation)
  - [List filesystems](#List-filesystems)
  - [Mounting](#Mounting)
  - [ISO to flash drive](#ISO-to-flash-drive)
  - [Formatting drive](#Formatting-drive)
  - [Format USB drive](#Format-USB-drive)
  - [Mount Google Drive](#Mount-Google-Drive)
  - [Locate file](#Locate-file)
  - [Search logs](#Search-logs)
- [Misc](#Misc)
  - [Set ACL](#Set-ACL)
  - [Print all locks](#Print-all-locks)
  - [Find file](#Find-file)
  - [Where the f\*ck is it placed](#Where-the-f\*ck-is-it-placed)
  - [Executable finding](#Executable-finding)
  - [Compile GraphQL schema to html](#Compile-GraphQL-schema-to-html)
- [Network](#Network)
  - [Check DNS text record](#Check-DNS-text-record)
  - [Scan ports](#Scan-ports)
  - [Check port](#Check-port)
  - [Show local ports](#Show-local-ports)
  - [Resolve host ip and mail exchanger](#Resolve-host-ip-and-mail-exchanger)
- [OS](#OS)
  - [Full system info](#Full-system-info)
  - [CPU info](#CPU-info)
  - [RAM info](#RAM-info)
  - [Running services](#Running-services)
  - [Show systemd logs](#Show-systemd-logs)
  - [Identify a kernel](#Identify-a-kernel)
- [Package management](#Package-management)
  - [Set alternative version](#Set-alternative-version)
  - [Full delete](#Full-delete)
  - [Search package](#Search-package)
- [Process](#Process)
  - [Print process tree](#Print-process-tree)
  - [Watch processes by pattern](#Watch-processes-by-pattern)
  - [Detailed process RAM usage](#Detailed-process-RAM-usage)
- [SSH](#SSH)
  - [Copy remote file](#Copy-remote-file)
  - [Upload to remote server](#Upload-to-remote-server)
  - [Open ssh-tunnel](#Open-ssh-tunnel)
  - [Pem file from private key](#Pem-file-from-private-key)
- [SSL](#SSL)
  - [renew particular cert](#renew-particular-cert)
  - [renew all certs and restart nginx](#renew-all-certs-and-restart-nginx)
- [Terminal](#Terminal)
  - [Terminfo compile description](#Terminfo-compile-description)
  - [Print terminfo description](#Print-terminfo-description)

# Archives

  - #### Compress folder
    
    ``` console
    whsv26@whsv26:~$ tar -zcf $ARCHIVE_NAME.tar.gz $FOLDER
    ```

  - #### Decompress folder
    
    ``` console
    whsv26@whsv26:~$ tar -zxf $ARCHIVE_NAME.tar.gz
    ```

  - #### Decompress to stdout
    
    ``` console
    whsv26@whsv26:~$ gzip -dc $ARCHIVE_NAME.gz
    ```

# Databases

## MySQL

  - #### Dump with condition
    
    ``` console
    whsv26@whsv26:~$ mysqldump --skip-lock-tables -P$PORT -h$HOST -u$USER -p$PASSWORD $DATABASE $TABLE --where="condition" | gzip > backup.sql.gz
    ```

  - #### Dump without exposed credentials
    
    ``` console
    whsv26@whsv26:~$ mysqldump --login-path=local --skip-lock-tables $DATABASE | gzip > backup.sql.gz
    ```

  - #### Reload configs
    
    ``` console
    whsv26@whsv26:~$ sudo /etc/init.d/mysql reload
    ```

  - #### Import a table from DB dump
    
    ``` console
    whsv26@whsv26:~$ sed -n -e '/DROP TABLE.*`mytable`/,/UNLOCK TABLES/p' mydump.sql > tabledump.sql
    ```

  - #### Migrate from MySQL to PostgreSQL
    
    ``` console
    whsv26@whsv26:~$ pgloader mysql://$USERNAME:$PASSWORD@$HOST:$PORT/$DATABASE postgresql://$USERNAME:$PASSWORD@$HOST:$PORT/$DATABASE
    ```

# Docker

  - #### Kill all running containers
    
    ``` console
    whsv26@whsv26:~$ docker kill $(docker ps -q) 
    ```

  - #### Import to mysql container with progress bar
    
    ``` console
    whsv26@whsv26:~$ pv ./dump.sql.gz | gunzip | docker exec -i $CONTAINER_NAME mysql -u$USERNAME -p$PASSWORD --database $DATABASE 
    ```

  - #### Psalm language server from docker container
    
    ``` console
    whsv26@whsv26:~$ docker-compose exec -T $SERVICE_NAME ./vendor/bin/psalm-language-server 
    ```

# Filesystem

  - #### List character devices
    
    ``` console
    whsv26@whsv26:~$ sed -n '/^Character/, /^$/ { /^$/ !p }' /proc/devices
    ```

  - #### List block devices
    
    ``` console
    whsv26@whsv26:~$ sed -n '/^Block/, /^$/ { /^$/ !p }' /proc/devices
    ```

  - #### List block devices in tree format with disk and part separation
    
    ``` console
    whsv26@whsv26:~$ lsblk
    ```

  - #### List filesystems
    
    ``` console
    whsv26@whsv26:~$ list filesystems
    whsv26@whsv26:~$ sudo fdisk -l
    ```

  - #### Mounting
    
    ``` console
    whsv26@whsv26:~$ DEVICE="/dev/sdb"
    whsv26@whsv26:~$ unmount $DEVICE
    ```

  - #### ISO to flash drive
    
    ``` console
    whsv26@whsv26:~$ ISO="ubuntu.iso" && DEVICE="/dev/sdb"
    whsv26@whsv26:~$ dd bs=4M if=$ISO of=$DEVICE conv=fdatasync status=progress
    ```

  - #### Formatting drive
    
    ``` console
    whsv26@whsv26:~$ FS="bfs|cramfs|ext2|ext3|ext4|f22fs|fat|minix|msdos|ntfs|vfat"
    whsv26@whsv26:~$ mkfs.$FS /dev/sdb
    ```

  - #### Format USB drive
    
    ``` console
    whsv26@whsv26:~$ lsblk
    sdc      8:32   1   7,2G  0 disk 
    └─sdc1   8:33   1   7,2G  0 part /media/whsv26/E0C9-E6FB
    whsv26@whsv26:~$ umount /dev/sdc1
    whsv26@whsv26:~$ mkfs.ext4 /dev/sdc1
    ```

  - #### Mount Google Drive
    
    ``` console
    whsv26@whsv26:~$ google-drive-ocamlfuse $MOUNT_FOLDER
    ```

  - #### Locate file
    
    ``` console
    whsv26@whsv26:~$ updatedb
    whsv26@whsv26:~$ locate $FILE
    ```

  - #### Search logs
    
    ``` console
    whsv26@whsv26:~$ rg -m $MAX_LINES -M $MAX_COLUMNS --max-columns-preview "$PATTERN" $FILE
    ```

# Misc

  - #### Set ACL
    
    ``` console
    whsv26@whsv26:~$ setfacl -R -m u:$USER:rwx $DIRECTORY_PATH
    ```

  - #### Print all locks
    
    ``` console
    whsv26@whsv26:~$ lslocks
    ```

  - #### Find file
    
    ``` console
    whsv26@whsv26:~$ find $FROM_PATH -name "file*.php" 
    ```

  - #### Where the f\*ck is it placed
    
    ``` console
    whsv26@whsv26:~$ readlink -f $SYMLINK
    ```

  - #### Executable finding
    
    ``` console
    whsv26@whsv26:~$ whereis
    whsv26@whsv26:~$ which
    ```

  - #### Compile GraphQL schema to html
    
    [@dependency](https://github.com/2fd/graphdoc)
    
    ``` console
    whsv26@whsv26:~$ SCHEMA="schema.graphql" && DIR="doc/schema" 
    whsv26@whsv26:~$ graphdoc -s $SCHEMA -o $DIR
    ```

# Network

  - #### Check DNS text record
    
    ``` console
    whsv26@whsv26:~$ dig
    ```

  - #### Scan ports
    
    ``` console
    whsv26@whsv26:~$ nmap -A -Pn $IP
    ```

  - #### Check port
    
    ``` console
    whsv26@whsv26:~$ nmap -vv -Pn -p $PORT $IP
    ```

  - #### Show local ports
    
    ``` console
    whsv26@whsv26:~$ sudo netstat -tulpn
    ```

  - #### Resolve host ip and mail exchanger
    
    ``` console
    whsv26@whsv26:~$ host $HOST
    ```

# OS

  - #### Full system info
    
    ``` console
    whsv26@whsv26:~$ dmidecode
    ```

  - #### CPU info
    
    ``` console
    whsv26@whsv26:~$ lscpu
    ```

  - #### RAM info
    
    ``` console
    whsv26@whsv26:~$ dmidecode --type memory | less
    ```

  - #### Running services
    
    ``` console
    whsv26@whsv26:~$ service --status-all
    ```

  - #### Show systemd logs
    
    ``` console
    whsv26@whsv26:~$ journalctl
    ```

  - #### Identify a kernel
    
    [@see](https://ubuntu.com/kernel)
    
    ``` console
    whsv26@whsv26:~$ cat /proc/version_signature
    ```

# Package management

  - #### Set alternative version
    
    ``` console
    whsv26@whsv26:~$ sudo update-alternatives --config php
    ```

  - #### Full delete
    
    ``` console
    whsv26@whsv26:~$ PACKAGE="package-name"
    whsv26@whsv26:~$ apt --purge remove "$PACKAGE*"
    whsv26@whsv26:~$ apt autoremove
    whsv26@whsv26:~$ apt autoclean
    ```

  - #### Search package
    
    ``` console
    whsv26@whsv26:~$ apt search $PACKAGEapt search $PACKAGE
    ```

# Process

  - #### Print process tree
    
    ``` console
    whsv26@whsv26:~$ print process tree
    whsv26@whsv26:~$ pstree -p
    whsv26@whsv26:~$ ps -ejH
    ```

  - #### Watch processes by pattern
    
    ``` console
    whsv26@whsv26:~$ watch 'ps faux | grep $PATTERN'
    ```

  - #### Detailed process RAM usage
    
    ``` console
    whsv26@whsv26:~$ sudo pmap $PID
    ```

# SSH

  - #### Copy remote file
    
    ``` console
    whsv26@whsv26:~$ scp -P$PORT $USER@$HOST:$REMOTE_PATH $LOCAL_PATH
    ```

  - #### Upload to remote server
    
    ``` console
    whsv26@whsv26:~$ scp -P$PORT $LOCAL_PATH $USER@$HOST:$REMOTE_PATH
    ```

  - #### Open ssh-tunnel
    
    ``` console
    whsv26@whsv26:~$ ssh -p $SSH_PORT -i ~/.ssh/$PRIVATE_KEY -N -L $LOCAL_PORT:$REMOTE_IP:$REMOTE_PORT $SSH_USER@$SSH_SERVER_IP
    ```

  - #### Pem file from private key
    
    ``` console
    whsv26@whsv26:~$ ssh-keygen -f ~/.ssh/$PRIVATE_KEY -em pem > $PEM_FILE_NAME.pem
    ```

# SSL

  - #### renew particular cert
    
    ``` console
    whsv26@whsv26:~$ certbot renew --dry-run --cert-name $CERT_NAME
    ```

  - #### renew all certs and restart nginx
    
    ``` console
    whsv26@whsv26:~$ certbot renew --post-hook "systemctl restart nginx"
    ```

# Terminal

  - #### Terminfo compile description
    
    ``` console
    whsv26@whsv26:~$ tic -xe $ENTRY $DOTINFO
    ```

  - #### Print terminfo description
    
    ``` console
    whsv26@whsv26:~$ infocmp $ENTRY
    ```
