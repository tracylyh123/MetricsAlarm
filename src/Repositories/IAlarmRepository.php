<?php
namespace MetricsAlarm\Repositories;

use MetricsAlarm\Alarms\AbstractAlarm;

interface IAlarmRepository
{
    /**
     * @param string $metric
     * @return AbstractAlarm[]
     */
    function findByMetric(string $metric): array;
}
