<?php
namespace MetricsAlarm\Changes\Values;

class OldValue extends AbstractValue
{
    public function __toString()
    {
        return "old value: {$this->getValue()} on {$this->getDateTime()}";
    }
}
