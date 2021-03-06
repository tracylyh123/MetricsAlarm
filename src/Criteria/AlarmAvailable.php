<?php
namespace MetricsAlarm\Criteria;

use MetricsAlarm\Alarms\AbstractAlarm;
use MetricsAlarm\Changes\AbstractChange;
use MetricsAlarm\Message;

class AlarmAvailable extends AbstractCriteria
{
    protected $alarm;

    protected $change;

    public function __construct(AbstractAlarm $alarm, AbstractChange $change)
    {
        $this->alarm = $alarm;
        $this->change = $change;
    }

    public function isSatisfy(): bool
    {
        return !$this->alarm->isAlarmed() && $this->alarm->isExceedThreshold($this->change);
    }

    public function createMessage(): Message
    {
        $message = new Message($this->alarm->__toString(), $this->alarm->getSendToType());
        return $message->addBody($this->change->__toString());
    }
}
