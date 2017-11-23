<?php

namespace Tests\Unit;

use Tests\TestCase;

class RootServerErrorTest extends TestCase
{
    /**
     * @return void
     */
    public function testRootOK()
    {
        $response = $this->get('/');

        $this->assertEquals(
            '', $response->getContent()
        );
        $this->assertEquals(
            '200', $response->status()
        );
    }

    public function testMethodNotAllowed()
    {
        $response = $this->post('/');

        $this->assertEquals(
            '405', $response->status()
        );
    }
}
