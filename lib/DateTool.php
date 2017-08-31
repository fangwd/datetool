<?php

class DateTool {

  const SECONDS = 1;
  const MINUTES = 60;
  const HOURS   = 60 * 60;
  const DAYS    = 60 * 60 * 24;
  const WEEKS   = 60 * 60 * 24 * 7;
  const YEARS   = 0;

  static function toTime($var) {
    if (is_string($var)) {
      $var = strtotime($var);
    }
    return $var;
  }

  static function count($from_date, $to_date, $scale=self::SECONDS) {
    if ($scale === self::WEEKS) {
      $from_date = self::toTime($from_date);
      $to_date = self::toTime($to_date);

      # assuming complete week means sunday 0:0:0 - next sunday 0:0:0
      $day_of_week = date('w', $from_date);
      if ($day_of_week != 0 || ($from_date % self::DAYS) != 0) {
        $from_date += (7 - $day_of_week) * self::DAYS;
        $from_date = floor($from_date / self::DAYS) * self::DAYS;
      }

      return floor(($to_date - $from_date) / self::WEEKS);
    }
    else if ($scale === self::YEARS) {
      $from_date = new DateTime($from_date);
      $to_date = new DateTime($to_date);
      return $to_date->diff($from_date)->y;
    }
    else {
      $from_date = self::toTime($from_date);
      $to_date = self::toTime($to_date);
      return ceil(($to_date - $from_date) / $scale);
    }
  } 

  static function countWeekdays($from_date, $to_date) {
    $days = self::count($from_date, $to_date, self::DAYS);
    $weeks = floor($days / 7); 
    $days_left = ceil($days - $weeks * 7);

    if ($days_left === 0) {
      return $weeks * 5;
    }

    $day_of_week = date('w', self::toTime($from_date));

    switch ($day_of_week) {
    case 0:
      $n = min($days_left, 6) - 1;
      break;
    case 1:
      $n = min($days_left, 5);
      break;
    case 2:
      $n = min($days_left, 4);
      break;
    case 3:
      $n = min($days_left, 3) + max($days_left - 5, 0);
      break;
    case 4:
      $n = min($days_left, 2) + max($days_left - 4, 0);
      break;
    case 5:
      $n = min($days_left, 1) + max($days_left - 3, 0);
      break;
    case 6:
      $n = min($days_left, 0) + max($days_left - 2, 0);
      break;
    }

    return $weeks * 5 + $n;
  }

  # Returns true if d1 is before d2
  static function isBefore($d1, $d2) {
    $d1 = new DateTime($d1);
    $d2 = new DateTime($d2);
    return $d1 < $d2;
  }

  static function isAfter($d1, $d2) {
    $d1 = new DateTime($d1);
    $d2 = new DateTime($d2);
    return $d1 > $d2;
  }
}

