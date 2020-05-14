du:
	docker-compose up -d
ds:
	docker-compose stop
db:
	docker-compose up --build -d
de:
	docker exec -it medical-booking-php sh
