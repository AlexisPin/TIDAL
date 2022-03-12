# TIDAL

### Equipe 5

# TIDAL_API
Route  | Methods         | Type | Description |
| :--------------- |:--------------- |:----- |:-----
| http://127.0.0.1/api/users.php  |   GET   |  JSON  | Retrieve all users. |
| http://127.0.0.1/api/users.php?id={id}  | GET  |   JSON  |   Recovering data from a single usere |
| http://127.0.0.1/api/users.php  | POST   |    JSON  |    Insert a new user into the database |
| http://127.0.0.1/api/users.php?id={id} | PUT     |    JSON   |    Update a user into the database |
| http://127.0.0.1/api/users.php?id={id} | DELETE     |    JSON   |    Delete a user from the database |
| http://127.0.0.1/api/pathologie.php  | GET  |   JSON | Retrieve all pathologies |
| http://127.0.0.1/api/pathologie.php?query={keyword}  | GET  |   JSON | Recovering a pathologie by a keyword |
| http://127.0.0.1/api/filter.php?meridien={meridien}&type={type}&caracteristique={caracteristique}  | GET  |   JSON | Recovering a pathologie by filter options of your choice |

Mise en place complete de l'API  
Utilisation des classes User et Pathologie sur tout le code  
Mise en place de la recherche par symptome ou mot clés au choix  
Page de pathologie unique avec la liste des symptomes associés  
Relations entre les options de filtrage permettant la sélection uniquement sur les options proposant un résultat  
