<?php
namespace MetricsAlarm;

use MetricsAlarm\Alarms\AbstractAlarm;
use MetricsAlarm\Changes\AbstractChange;

class Message
{
    protected $alarm;

    protected $change;

    public function __construct(AbstractAlarm $alarm, AbstractChange $change)
    {
        $this->alarm = $alarm;
        $this->change = $change;
    }

    public function isAvailable(int $sendToType): bool
    {
        return ($sendToType | $this->alarm->getSendToType()) === $this->alarm->getSendToType();
    }

    public function getTitle(): string
    {
        return $this->alarm->__toString();
    }

    public function getBody(): string
    {
        return $this->change->__toString();
    }
}
