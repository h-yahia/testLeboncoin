# Test Technique Leboncoin
## BEN YAHIA Habib

Voici les commandes pour lancer le test technique :
```sh
docker-compose build
docker-compose up -d
```
L'application est accèsible à cette url : http://127.0.0.1:8741/
Pour exécuter les tests il faut :
```sh
docker exec -it www_docker_symfony bash
./install.sh
````
Pour tester l'application il y a la collection Postman : `Leboncoin.postman_collection.json`