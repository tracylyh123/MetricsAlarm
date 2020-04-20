<?php
namespace MetricsAlarm;

use MetricsAlarm\Changes\Values\NewValue;
use MetricsAlarm\Changes\Values\OldValue;

class MetricChangedEvent
{
    protected $metric;

    protected $newValue;

    protected $oldValue;

    public function __construct(string $metric, NewValue $newValue, OldValue $oldValue)
    {
        $this->metric = $metric;
        $this->newValue = $newValue;
        $this->oldValue = $oldValue;
    }

    public function getMetric(): string
    {
        return $this->metric;
    }

    public function getNewValue(): NewValue
    {
        return $this->newValue;
    }

    public function getOldValue(): OldValue
    {
        return $this->oldValue;
    }

    public static function create(
        string $metric,
        float $newValue,
        string $newDateTime,
        float $oldValue,
        string $oldDateTime
    ): MetricChangedEvent {
        return new MetricChangedEvent(
            $metric,
            new NewValue($newValue, $newDateTime),
            new OldValue($oldValue, $oldDateTime)
        );
    }
}
