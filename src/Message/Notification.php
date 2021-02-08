<?php

/*
 * The MIT License
*
* Copyright (c) 2016-2021 Toha <tohenk@yahoo.com>
*
* Permission is hereby granted, free of charge, to any person obtaining a copy of
* this software and associated documentation files (the "Software"), to deal in
* the Software without restriction, including without limitation the rights to
* use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
* of the Software, and to permit persons to whom the Software is furnished to do
  * so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*/

namespace NTLAB\Message\Message;

use NTLAB\Message\Message;
use NTLAB\Message\Address\Internal as InternalAddress;

class Notification extends Message
{
    const ID = "NOTIF";

    const DELIVERY_INSTANT = 1;
    const DELIVERY_DELAYED = 2;

    /**
     * @var int
     */
    protected $delivery = self::DELIVERY_DELAYED;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var mixed
     */
    protected $referer;

    /**
     * @var mixed
     */
    protected $data;

    protected function init()
    {
        $this->type = static::ID;
        $this->addAddressType(InternalAddress::TYPE);
    }

    /**
     * Get notification delivery.
     *
     * @return int
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set notification delivery.
     *
     * @param int $delivery
     * @return \NTLAB\Message\Message\Notification
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * Get notification code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set notification code.
     *
     * @param string $code
     * @return \NTLAB\Message\Message\Notification
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get notification referer.
     *
     * @return mixed
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * Set notification referer.
     *
     * @param mixed $referer
     * @return \NTLAB\Message\Message\Notification
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;
        return $this;
    }

    /**
     * Get notification data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set notification data.
     *
     * @param mixed $data
     * @return \NTLAB\Message\Message\Notification
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
