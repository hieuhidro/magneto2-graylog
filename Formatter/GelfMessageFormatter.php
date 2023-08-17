<?php
/**
 * Created by Hidro Le.
 * Job Title: Magento Developer
 * Project Name: m2cedefault.local
 * Date: 8/9/20
 * Time: 15:55
 */

namespace Hidro\Graylog\Formatter;

use Monolog\Formatter\GelfMessageFormatter as MonologGelfMessageFormatter;

class GelfMessageFormatter extends MonologGelfMessageFormatter
{
    protected $_facility;

    /**
     * @return mixed
     */
    public function getFacility()
    {
        return $this->_facility;
    }

    /**
     * @param mixed $facility
     */
    public function setFacility($facility)
    {
        $this->_facility = $facility;
    }


    public function format(array $record): \Gelf\Message
    {
        //Update message channel to facility
        if($this->getFacility()) {
            $record['channel'] = $this->getFacility();
        }
        return parent::format($record); // TODO: Change the autogenerated stub
    }
}
