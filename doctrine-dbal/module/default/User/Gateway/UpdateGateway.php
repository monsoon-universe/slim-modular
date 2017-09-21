<?php
namespace Monsoon\User\Gateway;

use \Monsoon\User\Gateway\Gateway;
use \Monsoon\User\Model\Model;

class UpdateGateway extends Gateway
{
    public function updateUser(Model $user, array $where)
    {
        // Get data from the model.
        $name = $user->getName();
        $email = $user->getEmail();
        $updatedOn = $user->getUpdatedOn();

        // Get data from the params.
        $uuid = $where['uuid'];

        // Throw if empty.
        if (!$uuid) {
            throw new \Exception('$uuid is empty', 400);
        }

        // Throw if empty.
        if (!$name) {
            throw new \Exception('$name is empty', 400);
        }

        // Throw if empty.
        if (!$email) {
            throw new \Exception('$email is empty', 400);
        }

        // Throw if empty.
        if (!$updatedOn) {
            throw new \Exception('$updatedOn is empty', 400);
        }

        // Update user(s).
        // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/data-retrieval-and-manipulation.html#update
        $result = $this->connection
            ->update('user', [
                "name" => $name,
                "email" => $email,
                "updated_on" => $updatedOn
            ], [
                "uuid" => $uuid
            ]);

        // Throw if it fails.
        if ($result === 0) {
            throw new \Exception('Update row failed', 400);
        }

        // Return the model if it is OK.
        return $user;
    }
}