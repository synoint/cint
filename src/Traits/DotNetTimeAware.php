<?php
namespace Syno\Cint\Traits;

trait DotNetTimeAware
{
    /**
     * @param int $ticks
     *
     * @deprecated - use cintTimestampToUnixTimestamp
     *
     * @return int
     */
    protected function ticksToTime($ticks): int {
        return floor($ticks / 1000) - 61903;
    }

    /**
     * @param int $ticks
     *
     * @deprecated - use cintTimestampToDatetime
     *
     * @return string
     */
    protected function ticksToDatetime(int $ticks): string
    {
        return date('Y-m-d H:i:s', (floor($ticks / 1000) - 61903));
    }

    /**
     * @param int $ticks
     *
     * @deprecated - use cintTimestampToDate
     *
     * @return string
     */
    protected function ticksToDate(int $ticks): string
    {
        return date('Y-m-d', (floor($ticks / 1000) - 61903));
    }

    /**
     * @param int $ts
     *
     * @return int
     */
    protected function cintTimestampToUnixTimestamp(int $ts)
    {
        return (int) floor($ts / 1000);
    }

    /**
     * @param int ts
     *
     * @return string
     */
    protected function cintTimestampToDatetime(int $ts): string
    {
        return date('Y-m-d H:i:s', floor($ts / 1000));
    }

    /**
     * @param int ts
     *
     * @return string
     */
    protected function cintTimestampToDate(int $ts): string
    {
        return date('Y-m-d', floor($ts / 1000));
    }
}
