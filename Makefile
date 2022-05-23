
envs:
	cp -n ./app/.env.dev ./app/.env
	cp -n .env.dev .env
	export _uid=$$(id -u) && envsubst < .env.dev > .env

init: envs volume
	docker-compose down --remove-orphans
	docker-compose up -d --force-recreate*
	./php -- composer i --ignore-platform-reqs

down: envs
	docker-compose down --remove-orphans

volume:
	docker volume create --name zbbg.data-mysql || true

prune:
	docker-compose rm -fsv
	docker volume rm zbbg.data-mysql || true