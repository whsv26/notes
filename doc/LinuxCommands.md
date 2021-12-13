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
  - [Cleanup whole USB drive](#Cleanup-whole-USB-drive)
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
    tar -zcf $ARCHIVE_NAME.tar.gz $FOLDER
    ```

  - #### Decompress folder
    
    ``` console
    tar -zxf $ARCHIVE_NAME.tar.gz
    ```

  - #### Decompress to stdout
    
    ``` console
    gzip -dc $ARCHIVE_NAME.gz
    ```

# Databases

## MySQL

  - #### Dump with condition
    
    ``` console
    mysqldump --skip-lock-tables -P$PORT -h$HOST -u$USER -p$PASSWORD $DATABASE $TABLE --where="condition" | gzip > backup.sql.gz
    ```

  - #### Dump without exposed credentials
    
    ``` console
    mysqldump --login-path=local --skip-lock-tables $DATABASE | gzip > backup.sql.gz
    ```

  - #### Reload configs
    
    ``` console
    sudo /etc/init.d/mysql reload
    ```

  - #### Import a table from DB dump
    
    ``` console
    sed -n -e '/DROP TABLE.*`mytable`/,/UNLOCK TABLES/p' mydump.sql > tabledump.sql
    ```

  - #### Migrate from MySQL to PostgreSQL
    
    ``` console
    pgloader mysql://$USERNAME:$PASSWORD@$HOST:$PORT/$DATABASE postgresql://$USERNAME:$PASSWORD@$HOST:$PORT/$DATABASE
    ```

# Docker

  - #### Kill all running containers
    
    ``` console
    docker kill $(docker ps -q) 
    ```

  - #### Import to mysql container with progress bar
    
    ``` console
    pv ./dump.sql.gz | gunzip | docker exec -i $CONTAINER_NAME mysql -u$USERNAME -p$PASSWORD --database $DATABASE 
    ```

  - #### Psalm language server from docker container
    
    ``` console
    docker-compose exec -T $SERVICE_NAME ./vendor/bin/psalm-language-server 
    ```

# Filesystem

  - #### List character devices
    
    ``` console
    sed -n '/^Character/, /^$/ { /^$/ !p }' /proc/devices
    ```

  - #### List block devices
    
    ``` console
    sed -n '/^Block/, /^$/ { /^$/ !p }' /proc/devices
    ```

  - #### List block devices in tree format with disk and part separation
    
    ``` console
    lsblk
    ```

  - #### List filesystems
    
    ``` console
    list filesystems
    sudo fdisk -l
    ```

  - #### Mounting
    
    ``` console
    DEVICE="/dev/sdb"
    unmount $DEVICE
    ```

  - #### ISO to flash drive
    
    ``` console
    ISO="ubuntu.iso" && DEVICE="/dev/sdb"
    dd bs=4M if=$ISO of=$DEVICE conv=fdatasync status=progress
    ```

  - #### Formatting drive
    
    ``` console
    FS="bfs|cramfs|ext2|ext3|ext4|f22fs|fat|minix|msdos|ntfs|vfat"
    mkfs.$FS /dev/sdb
    ```

  - #### Format USB drive
    
    ``` console
    lsblk
    sdc      8:32   1   7,2G  0 disk 
    └─sdc1   8:33   1   7,2G  0 part /media/whsv26/E0C9-E6FB
    umount /dev/sdc1
    mkfs.ext4 /dev/sdc1
    ```

  - #### Cleanup whole USB drive
    
    ```console
    lsblk
    sdc      8:32   1   7,2G  0 disk 
    └─sdc1   8:33   1   7,2G  0 part /media/whsv26/E0C9-E6FB
    dd if=/dev/zero of=/dev/sdc1 bs=1M
    ```

  - #### Mount Google Drive
    
    ``` console
    google-drive-ocamlfuse $MOUNT_FOLDER
    ```

  - #### Locate file
    
    ``` console
    updatedb
    locate $FILE
    ```

  - #### Search logs
    
    ``` console
    rg -m $MAX_LINES -M $MAX_COLUMNS --max-columns-preview "$PATTERN" $FILE
    ```

# Misc

  - #### Set ACL
    
    ``` console
    setfacl -R -m u:$USER:rwx $DIRECTORY_PATH
    ```

  - #### Print all locks
    
    ``` console
    lslocks
    ```

  - #### Find file
    
    ``` console
    find $FROM_PATH -name "file*.php" 
    ```

  - #### Where the f\*ck is it placed
    
    ``` console
    readlink -f $SYMLINK
    ```

  - #### Executable finding
    
    ``` console
    whereis
    which
    ```

  - #### Compile GraphQL schema to html
    
    [@dependency](https://github.com/2fd/graphdoc)
    
    ``` console
    SCHEMA="schema.graphql" && DIR="doc/schema" 
    graphdoc -s $SCHEMA -o $DIR
    ```

# Network

  - #### Check DNS text record
    
    ``` console
    dig
    ```

  - #### Scan ports
    
    ``` console
    nmap -A -Pn $IP
    ```

  - #### Check port
    
    ``` console
    nmap -vv -Pn -p $PORT $IP
    ```

  - #### Show local ports
    
    ``` console
    sudo netstat -tulpn
    ```

  - #### Resolve host ip and mail exchanger
    
    ``` console
    host $HOST
    ```

# OS

  - #### Full system info
    
    ``` console
    dmidecode
    ```

  - #### CPU info
    
    ``` console
    lscpu
    ```

  - #### RAM info
    
    ``` console
    dmidecode --type memory | less
    ```

  - #### Running services
    
    ``` console
    service --status-all
    ```

  - #### Show systemd logs
    
    ``` console
    journalctl
    ```

  - #### Identify a kernel
    
    [@see](https://ubuntu.com/kernel)
    
    ``` console
    cat /proc/version_signature
    ```

# Package management

  - #### Set alternative version
    
    ``` console
    sudo update-alternatives --config php
    ```

  - #### Full delete
    
    ``` console
    PACKAGE="package-name"
    apt --purge remove "$PACKAGE*"
    apt autoremove
    apt autoclean
    ```

  - #### Search package
    
    ``` console
    apt search $PACKAGEapt search $PACKAGE
    ```

# Process

  - #### Print process tree
    
    ``` console
    print process tree
    pstree -p
    ps -ejH
    ```

  - #### Watch processes by pattern
    
    ``` console
    watch 'ps faux | grep $PATTERN'
    ```

  - #### Detailed process RAM usage
    
    ``` console
    sudo pmap $PID
    ```

# SSH

  - #### Copy remote file
    
    ``` console
    scp -P $PORT $USER@$HOST:$REMOTE_PATH $LOCAL_PATH
    ```

  - #### Upload to remote server
    
    ``` console
    scp -P $PORT $LOCAL_PATH $USER@$HOST:$REMOTE_PATH
    ```

  - #### Open ssh-tunnel
    
    ``` console
    ssh -p $SSH_PORT -i ~/.ssh/$PRIVATE_KEY -N -L $LOCAL_PORT:$REMOTE_IP:$REMOTE_PORT $SSH_USER@$SSH_SERVER_IP
    ```

  - #### Pem file from private key
    
    ``` console
    ssh-keygen -f ~/.ssh/$PRIVATE_KEY -em pem > $PEM_FILE_NAME.pem
    ```

# SSL

  - #### renew particular cert
    
    ``` console
    certbot renew --dry-run --cert-name $CERT_NAME
    ```

  - #### renew all certs and restart nginx
    
    ``` console
    certbot renew --post-hook "systemctl restart nginx"
    ```

# Terminal

  - #### Terminfo compile description
    
    ``` console
    tic -xe $ENTRY $DOTINFO
    ```

  - #### Print terminfo description
    
    ``` console
    infocmp $ENTRY
    ```
