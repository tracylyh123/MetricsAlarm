<?php
namespace MetricsAlarm\Senders;

use MetricsAlarm\Message;
use MetricsAlarm\User;

interface ISender
{
    function send(User $user, Message $message);

    function getSendToType(): int;
}
