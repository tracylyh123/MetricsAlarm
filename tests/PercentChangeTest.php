<?php
namespace Tests;

use MetricsAlarm\Changes\PercentChange;
use MetricsAlarm\Changes\Values\NewValue;
use MetricsAlarm\Changes\Values\OldValue;
use PHPUnit\Framework\TestCase;

class PercentChangeTest extends TestCase
{
    public function testGetValue()
    {
        $change = new PercentChange(new NewValue(50, '2020-04-05'), new OldValue(200, '2020-04-06'));
        $this->assertEquals(-75, $change->getValue());

        $change = new PercentChange(new NewValue(100, '2020-04-05'), new OldValue(200, '2020-04-06'));
        $this->assertEquals(-50, $change->getValue());

        $change = new PercentChange(new NewValue(200, '2020-04-05'), new OldValue(200, '2020-04-06'));
        $this->assertEquals(0, $change->getValue());

        $change = new PercentChange(new NewValue(300, '2020-04-05'), new OldValue(200, '2020-04-06'));
        $this->assertEquals(50, $change->getValue());

        $change = new PercentChange(new NewValue(400, '2020-04-05'), new OldValue(200, '2020-04-06'));
        $this->assertEquals(100, $change->getValue());
    }
}
