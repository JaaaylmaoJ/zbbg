<?php

namespace App\Repositories;

use PDO;
use App\Kernel\App;
use App\Repositories\Dto\UserDto;

class UserRepository implements UserRepositoryInterface
{
    public string $table = 'users';

    public function findById(int $id): ?UserDto
    {
        $sql = <<<SQL
select * from $this->table where id = :id
SQL;

        $statement = App::$instance->getDb()->prepare($sql);
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, UserDto::class);

        $user = $statement->fetch();

        return $user ?: null;
    }

    public function updateOne(UserDto $user): UserDto|bool
    {
        $sql = <<<SQL
update $this->table set days = :days, coins = :coins, dt = :dt where id = :id
SQL;
        $statement = App::$instance->getDb()->prepare($sql);
        $statement->bindParam('id', $user->id, PDO::PARAM_INT);
        $statement->bindParam('days', $user->days, PDO::PARAM_INT);
        $statement->bindParam('coins', $user->coins);
        $statement->bindParam('dt', $user->dt);

        $result = $statement->execute();
        $error  = $statement->errorInfo();

        return $result
            ? $this->findById($user->id)
            : $result;
    }
}