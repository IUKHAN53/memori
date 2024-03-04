<?php

use App\Models\SiteSettings;

function getLanguage() {
    return SiteSettings::query()->where('key', 'language')->first()->value ?? 'en';
}

function getDirection() {
    return SiteSettings::query()->where('key', 'text_direction')->first()->value ?? 'ltr';
}

function getShopUrl()
{
    return SiteSettings::query()->where('key', 'shopify_site_url')->first()->value ?? '';
}
