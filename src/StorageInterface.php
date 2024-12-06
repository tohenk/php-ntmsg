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

interface StorageInterface
{
    /**
     * Add outbound message to storage.
     *
     * @param Message $message
     * @param AddressInterface $to
     * @param AddressInterface $from
     */
    public function addOutbox(Message $message, AddressInterface $to, ?AddressInterface $from = null);

    /**
     * Add inbound message to storage.
     *
     * @param Message $message
     * @param AddressInterface $from
     * @param AddressInterface $to
     */
    public function addInbox(Message $message, AddressInterface $from, ?AddressInterface $to = null);

    /**
     * Add notification message to storage.
     *
     * @param Message $message
     * @param AddressInterface $to
     */
    public function addNotification(Message $message, AddressInterface $to);
}
