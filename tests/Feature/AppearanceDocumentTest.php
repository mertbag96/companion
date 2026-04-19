<?php

test('inertia document includes appearance meta defaulting to system', function () {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('<meta name="appearance" content="system"', false);
    $response->assertSee('document.documentElement.classList.toggle', false);
});

test('appearance meta reflects the appearance cookie when present', function () {
    $url = route('home', ['locale' => config('app.locale')]);

    $response = $this->call('GET', $url, [], ['appearance' => 'dark']);

    $response->assertSuccessful();
    $response->assertSee('<meta name="appearance" content="dark"', false);
});
