<?php
namespace MetricsAlarm\Changes;

class DifferenceChange extends AbstractChange
{
    public function getValue(): float
    {
        return $this->newValue->sub($this->oldValue);
    }
}
