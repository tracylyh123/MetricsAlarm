<?php
namespace MetricsAlarm\Criteria;

use MetricsAlarm\Message;

abstract class AbstractCriteria
{
    abstract public function createMessage(): Message;

    abstract public function isSatisfy(): bool;
}
