<?php
namespace Tests;

use MetricsAlarm\AlarmFactory;
use MetricsAlarm\MetricChangedEvent;
use MetricsAlarm\MetricChangedHandler;
use MetricsAlarm\Repositories\IAlarmRepository;
use MetricsAlarm\Repositories\IUserRepository;
use MetricsAlarm\Senders\ISender;
use MetricsAlarm\User;
use PHPUnit\Framework\TestCase;

class MetricChangedHandlerTest extends TestCase
{
    public function testHandle()
    {
        $alarmRepo = $this->createMock(IAlarmRepository::class);
        $alarmRepo->method('findByMetric')->willReturn([AlarmFactory::create(1, 10, 'revenue', 1, 2, 3)]);
        $userRepo = $this->createMock(IUserRepository::class);
        $user = new User(1, 'Tracy', 'traylyh123@gmail.com');
        $userRepo->method('findById')->willReturn($user);
        $sender1 = $this->createMock(ISender::class);
        $sender1->method('send')->will($this->returnCallback(function () {
            echo 'sent to email box' . PHP_EOL;
        }));
        $sender2 = $this->createMock(ISender::class);
        $sender2->method('send')->will($this->returnCallback(function () {
            echo 'sent to message box' . PHP_EOL;
        }));
        $user->addSender($sender1);
        $user->addSender($sender2);

        $event = MetricChangedEvent::create('revenue', 100, '2020-04-05 00:00:00', 200, '2020-04-06 00:00:00');
        $handler = new MetricChangedHandler($alarmRepo, $userRepo);
        $handler->handle($event);

        $this->expectOutputString('sent to email box' . PHP_EOL . 'sent to message box' . PHP_EOL);
    }
}
