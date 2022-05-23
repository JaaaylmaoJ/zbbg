
init:
	mkdir ./docker/mysql/data || true
	docker-compose down --remove-orphans
	docker-compose up -d --force-recreate

down:
	docker-compose down --remove-orphans

volume:
	docker volume create --name zbbg.data-mysql || true

prune:
	docker-compose rm -fsv
	docker volume rm zbbg.data-mysql || true