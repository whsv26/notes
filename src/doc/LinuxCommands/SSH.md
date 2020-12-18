# SSH
- Copy remote file
  ```console
  whsv26@whsv26:~$ scp -P$PORT $USER@$HOST:$REMOTE_PATH $LOCAL_PATH
  ```

- Open ssh-tunnel
  ```console
  whsv26@whsv26:~$ ssh -p $SSH_PORT -i ~/.ssh/$PRIVATE_KEY -N -L $LOCAL_PORT:$REMOTE_IP:$REMOTE_PORT $SSH_USER@$SSH_SERVER_IP
  ```

- Pem file from private key
  ```console
  whsv26@whsv26:~$ ssh-keygen -f ~/.ssh/$PRIVATE_KEY -em pem > $PEM_FILE_NAME.pem
  ```
