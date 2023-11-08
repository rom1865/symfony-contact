# Mise en place d'un projet SYMFONY - Symfony Contacts
## Author : Romain Crevet - crev0004
## Configuration
- apres un clone ou un pull du projet faire :
>composer install

- Copier le **.env** en **.env.local** et retirer les ligne suivante du commentaire et definissez elle avec vos infos : 

>DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"  
  
## Test Codeception : 

  
- Copier le .env.test en .env.test.local et copier la ligne de base de données dedans.

## Description des scripts composer 

- **start** :  
lance le serveur web local de symfony avec la commande suivante :
>composer start 
  
- **test:cs** :  
test le code php de la page avec la commande suivante :
> composer test:cs
  
- **fix:cs** :  
fix le code php de la page avec la commande suivante :  
> composer fix:cs  
  
- **test** : "Run all tests and run test codeception",  
  
>composer test  
  

-   **test:codeception** : 
"nettoie le repertoir output, detruit la base de données, crée une nouvelle , crée le schema de la bd et execute des tests codeception"  
  
>composer test:codeception  
  
- **db** : 
  
"générer de façon fiable une nouvelle base de données contenant les données factices."