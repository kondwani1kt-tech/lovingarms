<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            route('home'),
            route('about'),
            route('services'),
            route('how-it-works'),
            route('care-standards'),
            route('faq'),
            route('payment'),
            route('resources'),
            route('reviews'),
            route('careers'),
            route('contact'),
            route('staffing'),
            route('privacy'),
            route('privacy-practices'),
            route('terms'),
            route('accessibility'),
        ];

        foreach (array_keys(config('loving.services')) as $slug) {
            $urls[] = route('services.show', $slug);
        }

        foreach (array_keys(config('loving.areas')) as $slug) {
            $urls[] = route('areas.show', $slug);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= '  <url><loc>'.e($url).'</loc><lastmod>'.now()->toDateString().'</lastmod></url>'."\n";
        }

        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
