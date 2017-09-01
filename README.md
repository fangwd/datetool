A simple tool to help calculate days, weekdays, complete weeks (from Sunday 00:00:00 to Saturday 23:59:59) between two dates.

### Usage
```php
require 'lib/DateTool.php';

// Calculate the number of days between two dates
$days = DateTool::count('2017-08-31 18:00', '2017-09-30 18:00', DateTool::DAYS);

// Calculate the number of week days between two dates
$week_days = DateTool::countWeekdays('2017-08-31 18:00', '2017-09-30 18:00', DateTool::WEEKDAYS);

// Calculate the number of complete weeks between two dates
$weeks = DateTool::count('2017-08-31 18:00', '2017-09-30 18:00', DateTool::WEEKS);

// Calculate the number of hours between two dates
$hours = DateTool::count('2017-08-31 18:00', '2017-08-31 19:01', DateTool::HOURS);

// Test if one date is before another in different timezones
$is_before = DateTool::isBefore('2017-08-31 9:00 Australia/Adelaide', '2017-08-31 9:31 Australia/Sydney');
```

