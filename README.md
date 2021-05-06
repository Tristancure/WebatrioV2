Lancez composer install avant d'utiliser l'api

L'api utilise deux méthodes, save et show

Show permet de montrer toutes les personnes enregistrées dans la base de données classées par ordre alphabétique
Save permet d'enregistrer une nouvelle personne avec comme attributs : nom, prenom, date (Format : Jour-Mois-Année)

Exemple :

http://localhost/save?nom=Einstein&prenom=Albert&date='14-03-1879'