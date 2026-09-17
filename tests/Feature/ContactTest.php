<?php

use App\Livewire\Dashboard\Contact;
use Livewire\Livewire;

test('contact page displays the WhatsApp customer service link', function () {
    Livewire::test(Contact::class)
        ->assertSee('https://wa.link/bxlyp1');
});
