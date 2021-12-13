# SSH
- #### Copy remote file
  ```console
  scp -P $PORT $USER@$HOST:$REMOTE_PATH $LOCAL_PATH
  ```

- #### Upload to remote server
  ```console
  scp -P $PORT $LOCAL_PATH $USER@$HOST:$REMOTE_PATH
  ```

- #### Open ssh-tunnel
  ```console
  ssh -p $SSH_PORT -i ~/.ssh/$PRIVATE_KEY -N -L $LOCAL_PORT:$REMOTE_IP:$REMOTE_PORT $SSH_USER@$SSH_SERVER_IP
  ```

- #### Pem file from private key
  ```console
  ssh-keygen -f ~/.ssh/$PRIVATE_KEY -em pem > $PEM_FILE_NAME.pem
  ```
