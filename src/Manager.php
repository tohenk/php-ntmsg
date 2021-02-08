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

namespace NTLAB\Message;

use NTLAB\Message\Address\Internal as InternalAddress;

class Manager
{
    /**
     * @var ContactInterface
     */
    protected $user;

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var TransportInterface[]
     */
    protected $transport = [];

    /**
     * Get contact for current user.
     *
     * @return ContactInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set contact information for current user.
     *
     * @param ContactInterface $user
     * @return \NTLAB\Message\Manager
     */
    public function setUser(ContactInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get storage.
     *
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Set message storage handler.
     *
     * @param StorageInterface $storage
     * @return \NTLAB\Message\Manager
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * Add message transporter.
     *
     * @param Transport $transport
     * @return \NTLAB\Message\Manager
     */
    public function addTransport(Transport $transport)
    {
        $transport->setManager($this);
        $this->transport[] = $transport;
        return $this;
    }

    /**
     * Get the transporter capable of handling address.
     *
     * @param AddressInterface $address
     * @return TransportInterface
     */
    protected function getTransporter(AddressInterface $address)
    {
        foreach ($this->transport as $transport) {
            if ($transport->canHandle($address)) {
                return $transport;
            }
        }
    }

    /**
     * Send message.
     *
     * @param Message $message
     * @param ContactInterface $to
     * @throws \RuntimeException
     * @return int
     */
    public function send(Message $message, ContactInterface $to)
    {
        if (null === $this->storage) {
            throw new \RuntimeException('No message storage registered');
        }
        $count = 0;
        $sender = $this->getUser() ? $this->getUser()->getContactAddress(InternalAddress::TYPE) : null;
        foreach ($message->getSupportedAddresses($to) as $address) {
            if (!$address->isEnabled()) {
                continue;
            }
            if ($transport = $this->getTransporter($address)) {
                $this->storage->addOutbox($message, $address, $sender);
                if ($transport->send($message, $address)) {
                    $count++;
                }
            }
        }
        return $count;
    }
}
