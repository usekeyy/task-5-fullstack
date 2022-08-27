<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase; // ubah class parent
abstract class WebTestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';
}
