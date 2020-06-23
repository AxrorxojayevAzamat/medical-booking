du:
	docker-compose up -d
ds:
	docker-compose stop
db:
	docker-compose up --build -d
de:
	docker exec -it medical-booking-php sh
perm:
	sudo chown -R sandra database/seeds/*
	sudo chgrp -R sandra database/seeds/*
	sudo chmod -R 664 database/seeds/*        