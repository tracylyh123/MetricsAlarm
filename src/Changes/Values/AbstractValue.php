<?php
namespace MetricsAlarm\Changes\Values;

abstract class AbstractValue
{
    protected $value;

    protected $dateTime;

    public function __construct(float $value, string $dateTime)
    {
        $this->value = $value;
        $this->dateTime = $dateTime;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    public function isZero(): bool
    {
        return empty($this->value);
    }

    abstract public function __toString();
}
