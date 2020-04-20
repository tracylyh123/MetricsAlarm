<?php
namespace MetricsAlarm\Alarms;

use MetricsAlarm\Changes\AbstractChange;
use MetricsAlarm\Changes\DifferenceChange;
use MetricsAlarm\Changes\PercentChange;
use MetricsAlarm\Criteria\AbstractCriteria;
use MetricsAlarm\Criteria\AlarmAvailable;
use MetricsAlarm\MetricChangedEvent;
use MetricsAlarm\Types\ChangeTypes;

abstract class AbstractAlarm
{
    protected $authorId;

    protected $threshold;

    protected $metric;

    protected $isAlarmed = false;

    protected $changeType;

    protected $sendToType;

    public function __construct(
        string $authorId,
        float $threshold,
        string $metric,
        int $changeType,
        int $sendToType
    ) {
        $this->authorId = $authorId;
        $this->threshold = $threshold;
        $this->metric = $metric;
        $this->changeType = $changeType;
        $this->sendToType = $sendToType;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function getThreshold(): float
    {
        return $this->threshold;
    }

    public function alarm(): AbstractAlarm
    {
        $this->isAlarmed = true;
        return $this;
    }

    public function isAlarmed(): bool
    {
        return $this->isAlarmed;
    }

    public function getChangeType(): int
    {
        return $this->changeType;
    }

    public function isPercentChange(): bool
    {
        return ChangeTypes::CHANGE_PERCENT === $this->changeType;
    }

    public function isDifferenceChange(): bool
    {
        return ChangeTypes::CHANGE_DIFFERENCE === $this->changeType;
    }

    public function getSendToType(): int
    {
        return $this->sendToType;
    }

    protected function getStringFormat(): string
    {
        return str_replace('%', '%%', $this->metric) . " %s {$this->getThreshold()}" . ($this->isPercentChange() ? '%%' : '');
    }

    public function createCriteria(MetricChangedEvent $event): AbstractCriteria
    {
        switch ($this->getChangeType()) {
            case ChangeTypes::CHANGE_DIFFERENCE:
                $change = new DifferenceChange($event->getNewValue(), $event->getOldValue());
                break;
            case ChangeTypes::CHANGE_PERCENT:
                $change = new PercentChange($event->getNewValue(), $event->getOldValue());
                break;
            default:
                throw new \InvalidArgumentException('change type was undefined');
        }
        return new AlarmAvailable($this, $change);
    }

    abstract public function __toString();

    abstract public function isExceedThreshold(AbstractChange $change): bool;
}
