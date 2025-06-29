Les modifications à faire








Pour docker :

!!!Correction dans le fichier de conf, il faut remettre ce que j'ai rajouté (la réécriture des chemins)!!!

/etc/apache2/sites-available/000-sae202.conf:
```
<VirtualHost *:80>
    ServerName mmi24a09.sae202.ovh
    DocumentRoot /var/www/sae202

    <Directory /var/www/sae202>
        AllowOverride All
        Require all granted
	RewriteEngine On
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^([^/]+) index.php/$1
    </Directory>

    Alias /gestion /var/www/sae202/admin
    <Directory /var/www/sae202/admin>
        AllowOverride All
        AuthType Basic
        AuthName "Espace Administrateur"
	AuthUserFile /home/mmis2/htpassword.mmi
        Require valid-user
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/sae202-error.log
    CustomLog ${APACHE_LOG_DIR}/sae202-access.log combined
</VirtualHost>

```
Puis ne pas oublier de l'activer et de relancer apache
```
a2ensite 000-sae202.conf
service apache2 reload
```

Pour Github :

Pour récupérer les fichiers (la première fois uniquement): 
```
git init
git clone git@github.com:SamanthaPPW/sae202.git 
``` 
le lien est obtenable dans Code > SSH dans le github 

Si il y a une erreur, regardez la avec 
```
git status
```
(Si la branche est en retard, il faut récupérer les fichiers, voir plus bas,
Si elle est en avance, push un commit)

Pour voir les derniers commits :
```
git log --graph --all --oneline
```

Pour récupérer les fichiers, à faire avant chaque ajout au cas-où quelqu'un a modifié : 
```
git fetch #Récuperer les infos des nouveaux commits
git merge #Récuperer les commits du fetch dans nos dossiers locaux
``` 
OU
```
git pull #Fais les deux en un mais on peut ne pas comprendre les potentielles erreurs si il y en a
```

!!! NE PAS FAIRE D'AUTRES COMMITS SI IL Y A UN CONFLIT, IL FAUT REGLER LES SOUCIS AVANT!!!

Si il y a un conflit, github va modifier le fichier pour avoir les deux versions dedans

Pour ajouter un commit : 
```
git add . #Le point sert pour tout sélectionner, si vous voulez faire un choix précis remplacez le point, ajoute les fichiers dans le commit

git commit -m "Commentaire" #Nomme le commit avec un commentaire de votre choix et le place dans la branche main avec -m, mettez toujours des commentaires svp

git push -u origin main #Si vous voulez, à partir du 2e push, vous pouvez juste faire git push
```

En clair, n'oubliez pas de pull des commits, au cas-où quelqu'un modifie avant vous puis ajoutez votre commit :)

Pour la base de donnée :

Le fichier conf/conf.inc.php est un example de comment il doit être écrit. Il faut recréer le fichier sur les machines, sans les ajouter au github, les codes seront sur le Google Docs, ne faites donc plus de git add . mais spécifiez vos ajouts

Les informations concernant la création de la base de donnée viendront lors de la création de cette dernière.

Pour le VPS : 

Si jamais vous voulez publier maintenant (ce qui est inutile, on a besoin que d'un site hébergé pour l'instant), Changez bien les droits :

```
find /var/www/sae202 -type d -exec chmod 750 {} \; #Les dossier seront en 750
find /var/www/sae202 -type f -exec chmod 640 {} \; #Les fichiers, qui ne sont pas executables seront en 640 pour plus de sécurité
```


Modification de la table messagerie : 
```
ALTER TABLE messages ADD PRIMARY KEY (message_id);
ALTER TABLE messages MODIFY COLUMN message_id INT(11) AUTO_INCREMENT;

ALTER TABLE messages MODIFY COLUMN message_date_envoi DATETIME NOT NULL;

ALTER TABLE messages DROP COLUMN user_id;

ALTER TABLE messages ADD INDEX idx_expediteur (message_expediteur_id);
ALTER TABLE messages ADD INDEX idx_destinataire (message_destinataire_id);
ALTER TABLE messages ADD INDEX idx_date (message_date_envoi);

ALTER TABLE messages 
ADD CONSTRAINT fk_messages_expediteur 
FOREIGN KEY (message_expediteur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE;

ALTER TABLE messages 
ADD CONSTRAINT fk_messages_destinataire 
FOREIGN KEY (message_destinataire_id) REFERENCES utilisateurs(id) ON DELETE CASCADE;
```
