<?php

namespace App\Enums;

enum ScheduleType {
    case EveryDay = 'EVERY_DAY';
    case EveryOtherDay = 'EVERY_OTHER_DAY';
    case EveryOtherDayTwice = 'EVERY_OTHER_DAY_TWICE';
}
