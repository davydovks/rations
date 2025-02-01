<?php

namespace App\Enums;

enum ScheduleType: string {
    case EveryDay = 'EVERY_DAY';
    case EveryOtherDay = 'EVERY_OTHER_DAY';
    case EveryOtherDayTwice = 'EVERY_OTHER_DAY_TWICE';
}
