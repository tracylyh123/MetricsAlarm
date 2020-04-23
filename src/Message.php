<?php
namespace MetricsAlarm;

use MetricsAlarm\Alarms\AbstractAlarm;

class Message
{
    protected $alarm;

    protected $body = [];

    public function __construct(AbstractAlarm $alarm)
    {
        $this->alarm = $alarm;
    }

    public function isAvailable(int $sendToType): bool
    {
        return ($sendToType | $this->alarm->getSendToType()) === $this->alarm->getSendToType();
    }

    public function getTitle(): string
    {
        return $this->alarm->__toString();
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function addBody(string $body): Message
    {
        $this->body[] = $body;
        return $this;
    }
}
