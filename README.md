# Recette
Projet de recette


sudo docker run --name Recettebdd -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=Recette -p 3306:3306 -d mysql


sudo docker start Recettebdd


mysql -u root -p root

