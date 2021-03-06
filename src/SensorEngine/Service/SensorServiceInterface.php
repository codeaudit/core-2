<?php

namespace OpenDialogAi\SensorEngine\Service;

use OpenDialogAi\SensorEngine\SensorInterface;

/**
 * Deals with registering and exposing registered sensors
 */
interface SensorServiceInterface
{
    /**
     * Returns a list of all available sensors keyed by name
     *
     * @return SensorInterface[]
     */
    public function getAvailableSensors() : array;

    /**
     * Checks if an sensor with the given name has been registered
     *
     * @param string $sensorName Should be in the format sensor.{namespace}.{name}
     * @return bool
     */
    public function isSensorAvailable(string $sensorName) : bool;

    /**
     * Gets the registered sensor by name if it is registered
     * Should be in the format sensor.{namespace}.{name}
     *
     * @param $sensorName
     * @return SensorInterface
     */
    public function getSensor($sensorName) : SensorInterface;
}
