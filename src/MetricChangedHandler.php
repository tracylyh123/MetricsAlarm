<?php
namespace MetricsAlarm;

use MetricsAlarm\Repositories\IAlarmRepository;
use MetricsAlarm\Repositories\IUserRepository;

class MetricChangedHandler
{
    protected $alarmRepo;

    protected $userRepo;

    protected $criteria;

    public function __construct(
        IAlarmRepository $alarmRepo,
        IUserRepository $userRepo
    ) {
        $this->alarmRepo = $alarmRepo;
        $this->userRepo = $userRepo;
    }

    public function handle(MetricChangedEvent $event)
    {
        $alarms = $this->alarmRepo->findByMetric($event->getMetric());
        foreach ($alarms as $alarm) {
            $criteria = $alarm->createCriteria($event);
            if ($criteria->isSatisfy()) {
                $user = $this->userRepo->findById($alarm->getAuthorId());
                if ($user) {
                    $user->send($criteria->createMessage());
                }
            }
        }
    }
}
