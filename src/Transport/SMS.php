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

namespace NTLAB\Message\Transport;

use NTLAB\Message\Message;
use NTLAB\Message\Transport;
use NTLAB\Message\AddressInterface;
use NTLAB\Message\Address\PhoneNumber;
use NTLAB\Message\SMSInterface;

class SMS extends Transport
{
    /**
     * @var SMSInterface
     */
    protected $sms = null;

    /**
     * Constructor.
     *
     * @param SMSInterface $sms
     */
    public function __construct(SMSInterface $sms = null)
    {
        $this->sms = $sms;
    }

    public function canHandle(AddressInterface $address)
    {
        return null !== $this->sms && $address instanceof PhoneNumber ? true : false;
    }

    public function send(Message $message, AddressInterface $to)
    {
        if (null !== $this->sms) {
            return $this->sms->send($to->getAddress(), $message->getBody(), $message->getHash(), $message->getAttribute());
        }
    }
}
