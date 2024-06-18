<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LeafletMapTest extends DuskTestCase
{


    /**
     * A basic browser test example.
     */
    public function testdisplaymarker(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/mares')
                    ->assertSourceHas('leaflet-marker-icon');
        });
    }
}
