IndieFAQ
=========

So I run my own, small software company and needed to put together a help/FAQ site for my users. I wanted something clean and easy to manage, yet customizable. None of the existing FAQ web apps quite fit my needs. And I was trying to avoid using a pay-for solution such as ZenDesk, UserVoice, or Tender. (Believe it or not, the folks at Tender were some of the worst customer service I've ever dealt with.)

I ended up spending half a day creating my own FAQ site and this is the result. It displays Markdown formatted support articles, categorized, and searchable. The HTML is based on [Bootstrap](http://twitter.github.com/bootstrap/) and the PHP is from [the Simple PHP Framework](https://github.com/tylerhall/simple-php-framework/). You can [view a demo here](http://support.clickontyler.com).

INSTALL
-------

 * Upload the files into onto your PHP webserver
 * Create a MySQL database and import `Database.sql`
 * Rename `includes/class.config.php.SAMPLE` to `includes/class.config.php`
 * Edit `includes/class.config.php` and add your website's domain name to the `$productionServers` array at the top of the file.
 * Then, fill in your database details and admin password in the `prodiction()` method half way down the file.
 * You're finished. You can add/edit support articles via `admin.php`. For the time being, you'll have to add support sections via your favorite MySQL database client.

LICENSE
-------

The MIT License

Copyright (c) 2012 Tyler Hall <tylerhall AT gmail DOT com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

