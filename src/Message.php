<?php

/*
 * The MIT License
*
* Copyright (c) 2016-2024 Toha <tohenk@yahoo.com>
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

namespace NTLAB\Message;

class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $type = null;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \DateTime
     */
    protected $time = null;

    /**
     * @var array
     */
    protected $addresTypes = [];

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     */
    protected $attribute = 0;

    /**
     * Constructor.
     *
     * @param string $message  Message body
     */
    public function __construct($message)
    {
        $this->time = time();
        $this->body = $message;
        $this->hash = md5(uniqid(__CLASS__));
        $this->init();
    }

    protected function init()
    {
    }

    /**
     * Add supported address type.
     *
     * @param string $type
     */
    protected function addAddressType($type)
    {
        $this->addresTypes[] = $type;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \NTLAB\Message\MessageInterface::getType()
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     * @see \NTLAB\Message\MessageInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message subject.
     *
     * @param string $subject
     * @return \NTLAB\Message\Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \NTLAB\Message\MessageInterface::getBody()
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set message body.
     *
     * @param string $body
     * @return \NTLAB\Message\Message
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \NTLAB\Message\MessageInterface::getTime()
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set message time.
     *
     * @param int $time
     * @return \NTLAB\Message\Message
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get hashed unique id of the message.
     * 
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set message hash.
     *
     * @param string $hash
     * @return \NTLAB\Message\Message
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * Get message attribute.
     *
     * @return int
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set message attribute.
     *
     * @param int $attribute
     * @return \NTLAB\Message\Message
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * Get all supported addresses by the message.
     *
     * @param ContactInterface $contact
     * @return AddressInterface[]
     */
    public function getSupportedAddresses(ContactInterface $contact)
    {
        if (empty($this->addresTypes)) {
            return $contact->getContactAddresses();
        } else {
            $addresses = [];
            foreach ($this->addresTypes as $type) {
                if ($address = $contact->getContactAddress($type)) {
                    $addresses[] = $address;
                }
            }
            return $addresses;
        }
    }
}
