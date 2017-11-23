#!/bin/bash
echo 'Deploying Unicorns!'
cd /tmp
tar xzf package.tgz
cd /srv
mv /tmp/tmp/build ./new
sudo rm -rf socket-server_old
mv socket-server socket-server_old
mv new socket-server
cd /srv/socket-server
ln -s /srv/env/.env .env
touch /srv/socket-server/storage/logs/laravel.log
sudo find . -type f -name '.gitignore' -exec rm -f '{}' \;

# owners and permissions
sudo chown -R sockets:www-data /srv/socket-server
sudo chown -R www-data:www-data /srv/socket-server/storage/logs
sudo chown -R www-data:www-data /srv/socket-server/storage/framework/views
sudo chown -R www-data:www-data /srv/socket-server/storage/framework/cache
sudo chown -R www-data:www-data /srv/socket-server/storage/framework/sessions
sudo chmod 775 /srv/socket-server/storage/logs
sudo chmod 777 /srv/socket-server/storage/logs/laravel.log
sudo chmod 775 /srv/socket-server/storage/framework/views
sudo chmod 775 /srv/socket-server/storage/framework/cache
sudo chmod 775 /srv/socket-server/storage/framework/sessions

cd /srv/socket-server

# sensitive files
rm -rf scripts
rm -rf tests
rm -rf .git
rm -f .gitignore
rm -f .gitattributes
rm -f composer.*
rm -f .travis.yml
rm -f coverage.xml
rm -f phpunit.xml
rm -f readme.md
rm -f auth.json
rm -f laravel-echo-server-example-ssl.json
rm -f nginx.site.example.conf
rm -f supervisor-socket-server-example.conf

# go
php artisan migrate
service nginx restart
sudo supervisorctl reload
sudo supervisorctl restart socket-server:*
