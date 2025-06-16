Pour le docker :
/etc/apache2/sites-available/000-sae202.conf:
 <VirtualHost *:80>
        ServerName sae202.mmi-troyes.fr #le meme pour tous, ajouter :8215
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/sae202


        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

a2ensite 000-sae202.conf
service apache2 reload
