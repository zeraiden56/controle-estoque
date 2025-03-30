sudo rm -rf /var/www/html/controle-estoque && \
sudo cp -r /srv/controle-estoque /var/www/html/ && \
sudo chown -R www-data:www-data /var/www/html/controle-estoque && \
sudo chmod -R 755 /var/www/html/controle-estoque && \
sudo systemctl restart php8.3-fpm nginx
