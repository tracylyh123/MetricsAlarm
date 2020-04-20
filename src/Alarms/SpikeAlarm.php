<?php
namespace MetricsAlarm\Alarms;

use MetricsAlarm\Changes\AbstractChange;

class SpikeAlarm extends AbstractAlarm
{
    public function isExceedThreshold(AbstractChange $change): bool
    {
        return $change->isPositive() && $change->getValue() >= $this->getThreshold();
    }

    public function __toString(): string
    {
        return sprintf($this->getStringFormat(), 'spike >');
    }
}
