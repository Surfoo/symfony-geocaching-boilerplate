<?php

namespace App\Dao;

use App\Security\User;
use Geocaching\Lib\Utils\Utils;

class UserDao extends Dao
{
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function upsertUser(User $user): bool
    {
        $query = 'INSERT INTO players (user_id, username, avatar, membership_level_id)
                  VALUES (:userId, :username, :avatar, :membershipLevelId)
                  ON DUPLICATE KEY
                  UPDATE membership_level_id = :membershipLevelIdUpdate';

        $sth = $this->pdo->prepare($query);

        return $sth->execute([
            ':userId'                  => $user->getUserId(),
            ':username'                => $user->getUsername(),
            ':avatar'                  => $user->getAvatarUrl(),
            ':membershipLevelId'       => $user->getMembershipLevelId(),
            ':membershipLevelIdUpdate' => $user->getMembershipLevelId(),
        ]);
    }

    public function getByUsername(string $username): ?User
    {
        $query = 'SELECT *
                  FROM players
                  WHERE username = :username
                  LIMIT 1';

        $sth = $this->pdo->prepare($query);
        $sth->execute([':username' => $username]);
        $sth->setFetchMode(\PDO::FETCH_OBJ);
        $result = $sth->fetch();
        if (!$result) {
            return null;
        }

        return (new User())->setUserId($result->user_id)
                           ->setUsername($result->username)
                           ->setAvatarUrl($result->avatar)
                           ->setMembershipLevelId($result->membership_level_id)
                           ->setReferenceCode(Utils::idToReferenceCode($result->user_id, 'PR'))
                        ;
    }
}
