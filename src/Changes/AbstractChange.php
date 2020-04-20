<?php
namespace MetricsAlarm\Changes;

use MetricsAlarm\Changes\Values\NewValue;
use MetricsAlarm\Changes\Values\OldValue;

abstract class AbstractChange
{
    protected $newValue;

    protected $oldValue;

    public function __construct(NewValue $newValue, OldValue $oldValue)
    {
        $this->newValue = $newValue;
        $this->oldValue = $oldValue;
    }

    public function getNewValue(): NewValue
    {
        return $this->newValue;
    }

    public function getOldValue(): OldValue
    {
        return $this->oldValue;
    }

    public function getAbsValue(): float
    {
        return abs($this->getValue());
    }

    public function isNegative(): bool
    {
        return $this->getValue() < 0;
    }

    public function isPositive(): bool
    {
        return $this->getValue() > 0;
    }

    public function __toString()
    {
        return "{$this->oldValue->__toString()}, {$this->newValue->__toString()}, change: {$this->getValue()}";
    }

    abstract public function getValue(): float;
}
