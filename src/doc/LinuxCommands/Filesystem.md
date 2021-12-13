# Filesystem

- #### List character devices
  ```console
  sed -n '/^Character/, /^$/ { /^$/ !p }' /proc/devices
  ```

- #### List block devices
  ```console
  sed -n '/^Block/, /^$/ { /^$/ !p }' /proc/devices
  ```

- #### List block devices in tree format with disk and part separation
  ```console
  lsblk
  ```

- #### List filesystems
  ```console
  list filesystems
  sudo fdisk -l
  ```

- #### Mounting
  ```console
  DEVICE="/dev/sdb"
  unmount $DEVICE
  ```

- #### ISO to flash drive
  ```console
  ISO="ubuntu.iso" && DEVICE="/dev/sdb"
  dd bs=4M if=$ISO of=$DEVICE conv=fdatasync status=progress
  ```

- #### Formatting drive
  ```console
  FS="bfs|cramfs|ext2|ext3|ext4|f22fs|fat|minix|msdos|ntfs|vfat"
  mkfs.$FS /dev/sdb
  ```
- #### Format USB drive
  ```console
  lsblk
  sdc      8:32   1   7,2G  0 disk 
  └─sdc1   8:33   1   7,2G  0 part /media/whsv26/E0C9-E6FB
  umount /dev/sdc1
  mkfs.ext4 /dev/sdc1
  ```

- #### Mount Google Drive 
  ```console
  google-drive-ocamlfuse $MOUNT_FOLDER
  ```

- #### Locate file
  ```console
  updatedb
  locate $FILE
  ```

- #### Search logs
  ```console
  rg -m $MAX_LINES -M $MAX_COLUMNS --max-columns-preview "$PATTERN" $FILE
  ```
