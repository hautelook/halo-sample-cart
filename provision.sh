echo "export PATH=$PATH:/vagrant/bin" >> /home/vagrant/.profile
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install -q -y php5
sudo apt-get install -q -y git
sudo apt-get autoremove -y
curl -sS https://getcomposer.org/installer | php && sudo mv composer.phar /usr/local/bin/composer
cd /vagrant && composer install --prefer-dist
