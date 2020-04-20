<?php
namespace MetricsAlarm\Changes;

class PercentChange extends AbstractChange
{
    public function getValue(): float
    {
        if ($this->oldValue->isZero()) {
            throw new \InvalidArgumentException('cannot calculate change rate');
        }
        return $this->newValue->sub($this->oldValue) / $this->oldValue->getValue() * 100;
    }

    public function __toString()
    {
        return parent::__toString() . '%';
    }
}