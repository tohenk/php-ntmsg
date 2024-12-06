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

namespace NTLAB\Message\Address;

use NTLAB\Message\Address;

class Email extends Address
{
    const TYPE = "EMAIL";

    protected function init()
    {
        $this->type = static::TYPE;
    }

    /**
     * Get email address.
     *
     * @return string
     */
    public function getEmail()
    {
        if (is_array($address = $this->getAddress())) {
            $email = array_keys($address);
            $address = array_shift($email);
        }
        return $address;
    }

    /**
     * Format an email address.
     *
     * @param string $email  The email address
     * @param string $name   The people name
     * @return string|array
     */
    public static function format($email, $name = null)
    {
      if (0 === strlen($name)) {
          return $email;
      } else {
          return [$email => $name];
      }
    }

    public static function create($email, $name = null)
    {
        return new self(self::format($email, $name));
    }
}
