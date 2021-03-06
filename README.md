# Manuel d’utilisation

## Import des circonscriptions

Afin d’importer le fichier excel comprenant la liste des circonscriptions et leurs candidats (ou non) associés, le dit fichier doit respecter certaines normes.
Les colonnes seront au nombre de 12 et nommées comme suit :

    * departement
    * circo
    * titulaire_prenom
    * titulaire_nom
    * titulaire_bio
    * suppleant_prenom
    * suppleant_nom
    * suppleant_bio
    * facebook
    * twitter
    * email_campagne
    * blog

L’ordre n’a pas d’importance. La casse (majuscule/minuscule) n’a pas d’importance.
Les champs departement, circo, titulaire_nom et titulaire_bio ne peuvent pas être vide.

Le fichier doit être enregistré au format de texte CSV.

Une fois le fichier prêt, rendez-vous sur la page /circonscriptions/create. Un mini formulaire composé d’un bouton vous permettant de selectionner votre fichier, et d’un bouton de validation.

Un petit message devrait apparaître pour vous signaler le succès de l’import de celui-ci ou non. Si échec il y a, il se peut que le fichier soit manquant (erreur de manipulation) ou qu’un problème soit survenu lors de l’upload (entre le moment où le fichier est envoyé et le moment où il est reçu). Pour ces 2 situations l’erreur vous sera indiqué et je vous invite à recommencer. Si cela est sans succès alors contactez le service informatique.


## Visualisation des circonscriptions

Une fois le fichier importé vous pouvez vérifier par vous même l’état des circonscriptions. Si vous ne voulez pas chercher celles ci sur la carte vous pouvez taper l’adresse url comme suit : nomdedomaine/departement/numDep/circonscription/numCirco
(exemple : legislatives2017/departement/01/circonscription/2
ou legislativesfranceinsoumise/departement/01/circonscription/3
notez que vous devez écrire les numéros de département à un chiffre avec le 0.)

## Photos des candidats

Le nom des photos des candidat doit être de la forme:

[numéroDepartement]_[numéroCirconscription]_T.jpeg pour les titulaires
  par exemple: 1_2_T.jpg
    pour la photo du titulaire de l'Ain (département 01) deuxieme circonscription


[numéroDepartement]_[numéroCirconscription]_S.jpeg pour les suppléants
  par exemple: 1_2_S.jpg
    pour la photo du supléant de l'Ain (département 01) deuxieme circonscription


remarque: les photos des départements à un chiffre (l'Ain, l'Aisne, l'Allier, ....) doivent avoir dans
          leur nom un numéro de département a un chiffre.
          Concrétement: numéroDepartement vaut 1 pour l'Ain, 2 pour l'Aisne, 3 pour Allier, ... 9
                        pour l'Ariège.


les photos ne devraient, dans l'idéal, pas exeder les 200 KO (kilo octets) et avoir une largeur d'environs 400px.


## Modification des circonscriptions

Si vous souhaitez ajouter ou modifier des circonscriptions vous pouvez soit reprendre votre fichier csv, le modifier et l’importer comme précédemment ou prendre un nouveau fichier, le remplir avec les circonscriptions que vous voulez ajouter et/ou modifier et l’importer comme précédemment.

Si une circonscription existe déjà en base de données, indépendemment de sa position. Si elle existe il va la mettre à jour avec les informations, qu’elles soient identiques ou non aux précédentes. Si elle n’existe pas, il va l’ajouter avec les informations correspondantes.

Donc, vous pouvez reprendre votre ancien fichier, y laisser vos circonscriptions même si vous les avez déjà ajoutés, elles ne seront pas dupliqués et/ou ré ajoutés.


## Suppression des circonscriptions

Ce que cela signifie également c’est que importer un nouveau fichier sans certaines circonscriptions précédemment ajoutées ne va pas les supprimer.
Si vous souhaitez supprimer une circonscription (dans le cas où vous en auriez ajouté une qui n’existe physiquement pas, par exemple la 10e circonscription de l’Ain) au moment où j’écris ces lignes la seule manière de le faire est manuelle, directement dans la base de données. Pour supprimer une circonscription contactez le service informatique.


## Message personnalisé sur les circonscriptions

Si une circonscription n’a pas de candidat et que vous souhaitez afficher un message personnalisé pour celle ci, ajoutez une ligne correspondante à cette circonscription dans votre fichier csv, avec au sein du champ nomTitu la chaine de caractère suivante : « noexist » et dans le champ bioTitu votre message personnalisé.


## Créer un utilisateur

Sur console veuillez suivre cette procédure:

```
php artisan tinker /* ouvre l'invite de comande liéé a laravel*/
$user = new App\User();
$user->password = Hash::make('the-password-of-choice');
$user->email = 'the-email@example.com';
$user->name = 'the-name';
$user->save();
```
