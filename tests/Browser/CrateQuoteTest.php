<?php

namespace Tests\Browser;

use \App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CrateQuoteTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $browser->pause(1000);
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login');
            $browser->visit('/quotes/create')
                ->type('text', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.')
                ->type('author', 'Lorem ipsum')
                ->select('category')
                ->select('subcategory')
                ->press('Submit');;
            $browser->assertSee('Task was successful!');
        });
    }
}
