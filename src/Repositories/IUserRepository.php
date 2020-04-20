<?php
namespace MetricsAlarm\Repositories;

use MetricsAlarm\User;

interface IUserRepository
{
    /**
     * @param string $id
     * @return User|null
     */
    function findById(string $id): ?User;
}
