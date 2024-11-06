# add this line in file php.ini for enable ioncube
zend_extension = /var/www/ioncube_loader_lin_7.4.so


#=====================Start Command.sh=================
#!/bin/bash
for i in {8002..8066}
 
#for f in $(find  -name 'docker-compose-*.yml' -print | sort -n)
do
  echo "=========== Nomor ke-$i=============="
  # cd ./html
  # # rm -rf opensid$i
  # cp -r opensid8012 opensid$i
  # cd ..
  # docker-compose up -d opensid$i
  docker-compose restart opensid$i

  # cd ./.docker/nginx
  # cp nginx8002.conf nginx$i.conf
  # cd ../..

#first change folder permission for folder opensid 
  # docker-compose exec php_opensid chown -f www-data.www-data /public_html/opensid$i
  # docker-compose exec php_opensid chown -Rf www-data.www-data /public_html/opensid$i/storage
  # docker-compose exec php_opensid chown -Rf www-data.www-data /public_html/opensid$i/backup_inkremental
  # docker-compose exec php_opensid mkdir /public_html/opensid$i/desa
  # docker-compose exec php_opensid chown -Rf www-data.www-data /public_html/opensid$i/desa


  # docker exec mysql-server mysql -uroot -ppassworddiskominfo! -e "DROP DATABASE opensid$i;"
  echo "======================================="
done
#==================end file======================================



Make sure that the theme directory on your host has the correct permissions for Docker to read/write. Run the following commands to ensure the permissions are correct:

sudo chown -R www-data:www-data /home/diskominfo/opensid-desa/.docker/themes
sudo chmod -R 775 /home/diskominfo/opensid-desa/.docker/themes
