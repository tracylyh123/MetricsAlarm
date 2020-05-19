<?php
namespace MetricsAlarm;

use MetricsAlarm\Senders\ISender;

trait AlarmableTrait
{
    /**
     * @var ISender[]
     */
    protected $senders = [];

    public function addSender(ISender $sender)
    {
        $this->senders[$sender->getSendToType()] = $sender;
    }

    public function send(Message $message)
    {
        if ($this instanceof User) {
            foreach ($this->senders as $type => $sender) {
                if ($message->canBeSentTo($type)) {
                    $sender->send($this, $message);
                }
            }
        } else {
            throw new \LogicException("this entity cannot alarm: " . get_class($this));
        }
    }
}
