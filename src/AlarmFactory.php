<?php
namespace MetricsAlarm;

use MetricsAlarm\Alarms\AbstractAlarm;
use MetricsAlarm\Alarms\DropAlarm;
use MetricsAlarm\Alarms\SpikeAlarm;
use MetricsAlarm\Types\AlarmTypes;

class AlarmFactory
{
    public static function create(
        string $authorId,
        float $threshold,
        string $name,
        int $alarmType,
        int $changeType,
        int $sendToType
    ): AbstractAlarm
    {
        switch ($alarmType) {
            case AlarmTypes::TYPE_DROP:
                $alarm = new DropAlarm($authorId, $threshold, $name, $changeType, $sendToType);
                break;
            case AlarmTypes::TYPE_SPIKE:
                $alarm = new SpikeAlarm($authorId, $threshold, $name, $changeType, $sendToType);
                break;
            default:
                throw new \InvalidArgumentException("invalid type: {$alarmType}");
        }
        return $alarm;
    }
}
