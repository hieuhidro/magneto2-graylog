<?php

/**
 * Created by Hidro Le.
 * Job Title: Magento Developer
 * Project Name: local.magento2.com
 * Date: 07/08/2020
 * Time: 18:39
 */

namespace Hidro\Graylog\Logger\Handler;

use Hidro\Graylog\Formatter\GelfMessageFormatter;
use Monolog\Logger;

class Graylog extends \Monolog\Handler\GelfHandler
{
    /**
     * @var mixed|string
     */
    protected $facility;

    /**
     * Graylog constructor.
     *
     * @param \Hidro\Graylog\Logger\GraylogBuilder $graylogBuilder
     * @param string                               $facility
     * @param int                                  $level
     * @param bool                                 $bubble
     */
    public function __construct(
        \Hidro\Graylog\Logger\GraylogBuilder  $graylogBuilder,
        $facility = '',
        $level = Logger::DEBUG,
        $bubble = true)
    {
        //Repair publisher
        $publisher = $graylogBuilder->getPublisher();
        $this->facility = $facility ?: $graylogBuilder->getFacility();
        parent::__construct($publisher, $level, $bubble);
    }

    /**
     * Accept all error logs
     * @param array $record
     * @return bool
     */
    public function isHandling(array $record)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        //Update message channel to facility
        $messageFormatter = new GelfMessageFormatter();
        $messageFormatter->setFacility($this->facility);
        return $messageFormatter;
    }
}
