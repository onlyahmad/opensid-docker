#!/bin/bash
for i in {8002..8066}
 
#for f in $(find  -name 'docker-compose-*.yml' -print | sort -n)
do
  echo "=========== Nomor ke-$i=============="
  # cp -r html/opensid8061/desa/themes/denava html/opensid$i/desa/themes
  # cd ./html
  rm -rf html/opensid$i/desa/themes/denava
  # cp -r opensid8012 opensid$i
  # cd ..
  # docker-compose up -d opensid$i
  # docker-compose restart opensid$i

  # cd ./.docker/nginx
  # cp nginx8002.conf nginx$i.conf
  # cd ../..

  # docker-compose exec php_opensid chown -f www-data.www-data /public_html/opensid$i
  # docker-compose exec php_opensid chown -Rf www-data.www-data /public_html/opensid$i/storage
  # docker-compose exec php_opensid chown -Rf www-data.www-data /public_html/opensid$i/backup_inkremental
  # docker-compose exec php_opensid mkdir /public_html/opensid$i/desa
  # docker-compose exec php_opensid chown -Rf www-data.www-data /public_html/opensid$i/desa
  # docker exec mysql-server mysql -uroot -ppassworddiskominfo! -e "DROP DATABASE opensid$i;"
  echo "======================================="
done
