<?php
namespace Syno\Cint\Traits;

trait DotNetTimeAware
{
    /**
     * @param int $ticks
     *
     * @return int
     */
    protected function ticksToTime($ticks): int {
        return floor($ticks / 1000) - 61903;
    }

    /**
     * @param int $ticks
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
     * @return string
     */
    protected function ticksToDate(int $ticks): string
    {
        return date('Y-m-d', (floor($ticks / 1000) - 61903));
    }
}
