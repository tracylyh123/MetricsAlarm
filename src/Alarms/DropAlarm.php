<?php
namespace MetricsAlarm\Alarms;

use MetricsAlarm\Changes\AbstractChange;

class DropAlarm extends AbstractAlarm
{
    public function isExceedThreshold(AbstractChange $change): bool
    {
        return $change->isNegative() && $change->getAbsValue() >= $this->getThreshold();
    }

    public function __toString(): string
    {
        return sprintf($this->getStringFormat(), 'drop >');
    }
}
