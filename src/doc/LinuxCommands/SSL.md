# SSL
- #### renew particular cert
  ```console
  whsv26@whsv26:~$ certbot renew --dry-run --cert-name $CERT_NAME
  ```

- #### renew all certs and restart nginx
  ```console
  whsv26@whsv26:~$ certbot renew --post-hook "systemctl restart nginx"
  ```
