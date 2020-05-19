<?php
namespace MetricsAlarm;

class Message
{
    protected $title;

    protected $sendToType;

    protected $body = [];

    public function __construct(string $title, int $sendToType)
    {
        $this->title = $title;
        $this->sendToType = $sendToType;
    }

    public function isMatch(int $sendToType): bool
    {
        return ($sendToType | $this->sendToType) === $this->sendToType;
    }

    public function getTitle(): string
    {
        return $this->title;
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
