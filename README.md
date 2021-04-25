# magento2

## Brief
## Requirement
Docker and Docker compose
## Install
Run step by step command
```bash
docker-compose up -d

docker-compose exec fpm sh

composer install

find var generated vendor pub/static pub/media app/etc -type f -exec chmod g+w {} +
find var generated vendor pub/static pub/media app/etc -type d -exec chmod g+ws {} +
chown -R :www-data .
chmod u+x bin/magento

bin/magento setup:install \
    module:disable Magento_TwoFactorAuth \
  --base-url=http://localhost:8000 \
  --db-host=db \
  --db-name=magento2 \
  --db-user=root \
  --db-password=P4ssw0rd12@ \
  --admin-firstname=admin \
  --admin-lastname=admin \
  --admin-email=admin@admin.com \
  --admin-user=admin \
  --admin-password=admin123 \
  --language=en_US \
  --currency=USD \
  --timezone=America/New_York \
  --use-rewrites=1 \
  --elasticsearch-host=elasticsearch \
  --elasticsearch-port=9200
```
note: 
Magento Admin URI: /admin_afow1d 
Username/Password: admin/admin123 
