<?php

use App\Support\LocalizedRoutePaths;
use Illuminate\Support\Facades\URL;
use Inertia\Testing\AssertableInertia as Assert;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

test('root redirects to the default locale home', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('home'));
});

test('home page returns expected translation strings for english', function () {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Home')
        ->where('translations.website.home.heading', 'Homepage'));
});

test('home page returns turkish copy when locale is tr', function () {
    LaravelLocalization::setLocale('tr');
    URL::defaults(array_merge(
        ['locale' => 'tr'],
        LocalizedRoutePaths::urlDefaultsForLocale('tr'),
    ));

    $response = $this->get(route('home', ['locale' => 'tr']));

    $response->assertSuccessful();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Home')
        ->where('translations.website.home.heading', 'Ana sayfa'));
});

test('unknown locale segment does not match routes', function () {
    $response = $this->get('/xx');

    $response->assertNotFound();
});

test('shared locale_urls contains alternate locale for current page', function () {
    $response = $this->get(route('home', ['locale' => 'en']));

    $response->assertSuccessful();
    $response->assertInertia(fn (Assert $page) => $page
        ->has('locale_urls.tr')
        ->where('locale_urls.tr', fn ($url): bool => is_string($url) && str_contains($url, '/tr')));
});
