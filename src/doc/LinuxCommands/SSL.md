# SSL
- #### renew particular cert
  ```console
  certbot renew --dry-run --cert-name $CERT_NAME
  ```

- #### renew all certs and restart nginx
  ```console
  certbot renew --post-hook "systemctl restart nginx"
  ```
