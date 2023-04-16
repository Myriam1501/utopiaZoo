# ![WebApp](https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCqzoNeBt-LJK2x_pwmopdX392T2ec5zdTQg&usqp=CAU)
# [UtopiaZoo](https://iharsh234.github.io/WebApp/) 
<table>
<tr>
<td>
	UtopiaZoo est un projet de site web pour un parc zoologique fictif. Le site web a été développé dans le cadre d'un projet scolaire. Ce projet est actuellement fini dans la branche main.

</td>
</tr>
</table>

## Usage

### Installation

- Fork le repository
- Aller sur le terminal et installer le composer : composer install
- crée votre base de donner en la connectant à votre Base de donnée dans .env puis faire les manipulation suivante :
- 	php ./bin/console d:d:c (votrebasededonner)
- 	php ./bin/console d:migrate:migration
- 	php ./bin/console make:migration
- Aller sur le terminal et télécharger les fixtures : php ./bin/composer doctrine:fixtures:load

C'est fini vous pouvez découvrir notre manifique zoo en lançant dans votre lacalhost!

## Site & Fonctionnaliter 

### Page d'acueil
Accueil dynamique avec une vidéo et des animations

### Proteger les animaux
Affichage de l'histoire du zoo

### Decouvrir
Fonctionnalité : interaction avec des bruit, un plan interactif

### Espace jeu
Fonctionnalité : 3 jeux + un quiz avec la possibilité de gagner un code promo

### Connexion, mot de passe oublier & Inscription
Ici la fonctionnalité principal est l'utilisation de mailer en cas d'oublie de mot de passe ou de création de compte

### Profil
Fonctionnalité : voir son profil et modifier (CRUD)

### Gestion côté admin
Fonctionnalité : CRUD et géré toutes les fonctionnalité nécessaire à l'admin


### Preparer sa visite, Panier, reserver, Payment et PDF confirmation
Fonctionnalités :
- PDF api
- mise au panier
- payement API
- Base de donner reservation 
- ...

## [Construction](https://iharsh234.github.io/WebApp/) 

- [Github Project](https://github.com/users/Myriam1501/projects/4) - Dans le github parti Project, equivalent au Trello
- [Bootstrap](http://getbootstrap.com/) - Site pour le css
- [FontAwaysome](https://fontawesome.com) - le boostrap des icons

## [équipe](https://iharsh234.github.io/WebApp/) 

[Meryam GHULAM](https://github.com/meryamgh)

[Amel Naloufi](https://github.com/AmelNal22)

[Myriam OUNISSI](https://github.com/Myriam1501)

[Haoyue LIU ](https://github.com/LOliviaL) 


