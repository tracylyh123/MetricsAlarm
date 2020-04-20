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
        $alarms = [
            AlarmFactory::create(1, 10, 'revenue', 1, 2, 3),
            AlarmFactory::create(2, 10, 'revenue', 1, 2, 1)
        ];
        $alarmRepo->method('findByMetric')->willReturn($alarms);
        $userRepo = $this->createMock(IUserRepository::class);
        $user1 = new User(1, 'Tracy', 'traylyh123@gmail.com');
        $user2 = new User(2, 'cuixi', '793889968@qq.com');
        $userRepo->method('findById')->will($this->returnValueMap([
            ['1', $user1],
            ['2', $user2]
        ]));
        $sender1 = $this->createMock(ISender::class);
        $sender1->method('send')->will($this->returnCallback(function () {
            echo 'sent to email box' . PHP_EOL;
        }));
        $sender1->method('getSendToType')->willReturn(1);
        $sender2 = $this->createMock(ISender::class);
        $sender2->method('send')->will($this->returnCallback(function () {
            echo 'sent to message box' . PHP_EOL;
        }));
        $sender2->method('getSendToType')->willReturn(2);

        $user1->addSender($sender1);
        $user1->addSender($sender2);
        $user2->addSender($sender1);
        $user2->addSender($sender2);

        $event = MetricChangedEvent::create('revenue', 100, '2020-04-05 00:00:00', 200, '2020-04-06 00:00:00');
        $handler = new MetricChangedHandler($alarmRepo, $userRepo);
        $handler->handle($event);

        $this->expectOutputString('sent to email box' . PHP_EOL . 'sent to message box' . PHP_EOL . 'sent to email box' . PHP_EOL);
    }
}
