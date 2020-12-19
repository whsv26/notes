# Filesystem

- #### List character devices
  ```console
  whsv26@whsv26:~$ sed -n '/^Character/, /^$/ { /^$/ !p }' /proc/devices
  ```

- #### List block devices
  ```console
  whsv26@whsv26:~$ sed -n '/^Block/, /^$/ { /^$/ !p }' /proc/devices
  ```

- #### List block devices in tree format with disk and part separation
  ```console
  whsv26@whsv26:~$ lsblk
  ```

- #### List filesystems
  ```console
  whsv26@whsv26:~$ list filesystems
  whsv26@whsv26:~$ sudo fdisk -l
  ```

- #### Mounting
  ```console
  whsv26@whsv26:~$ DEVICE="/dev/sdb"
  whsv26@whsv26:~$ unmount $DEVICE
  ```

- #### ISO to flash drive
  ```console
  whsv26@whsv26:~$ ISO="ubuntu.iso" && DEVICE="/dev/sdb"
  whsv26@whsv26:~$ dd bs=4M if=$ISO of=$DEVICE conv=fdatasync status=progress
  ```

- #### Formatting drive
  ```console
  whsv26@whsv26:~$ FS="bfs|cramfs|ext2|ext3|ext4|f22fs|fat|minix|msdos|ntfs|vfat"
  whsv26@whsv26:~$ mkfs.$FS /dev/sdb
  ```
- #### Format USB drive
  ```console
  whsv26@whsv26:~$ lsblk
  sdc      8:32   1   7,2G  0 disk 
  └─sdc1   8:33   1   7,2G  0 part /media/whsv26/E0C9-E6FB
  whsv26@whsv26:~$ umount /dev/sdc1
  whsv26@whsv26:~$ mkfs.ext4 /dev/sdc1
  ```