<?php
namespace MetricsAlarm\Changes\Values;

class NewValue extends AbstractValue
{
    public function __toString()
    {
        return "new value: {$this->getValue()} on {$this->getDateTime()}";
    }

    public function sub(OldValue $oldValue): float
    {
        return $this->value - $oldValue->getValue();
    }
}
