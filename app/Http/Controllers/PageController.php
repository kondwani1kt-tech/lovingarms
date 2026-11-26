<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => config('loving.services'),
            'areas' => config('loving.areas'),
            'faqs' => array_slice(config('loving.faqs'), 0, 4),
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services', ['services' => config('loving.services')]);
    }

    public function service(string $slug)
    {
        $service = config('loving.services.'.$slug);
        abort_unless($service, 404);

        return view('pages.service', [
            'slug' => $slug,
            'service' => $service,
            'services' => config('loving.services'),
        ]);
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function careStandards()
    {
        return view('pages.care-standards');
    }

    public function faq()
    {
        return view('pages.faq', ['faqs' => config('loving.faqs')]);
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function resources()
    {
        return view('pages.resources');
    }

    public function reviews()
    {
        return view('pages.reviews', ['reviews' => config('loving.reviews')]);
    }

    public function area(string $slug)
    {
        $area = config('loving.areas.'.$slug);
        abort_unless($area, 404);

        return view('pages.area', [
            'slug' => $slug,
            'area' => $area,
            'areas' => config('loving.areas'),
            'services' => config('loving.services'),
        ]);
    }

    public function careers()
    {
        return view('pages.careers', ['roles' => config('loving.career_roles')]);
    }

    public function contact()
    {
        return view('pages.contact', ['for' => request('for')]);
    }

    public function staffing()
    {
        return view('pages.staffing');
    }

    public function privacy()
    {
        return view('pages.legal.privacy');
    }

    public function privacyPractices()
    {
        return view('pages.legal.privacy-practices');
    }

    public function terms()
    {
        return view('pages.legal.terms');
    }

    public function accessibility()
    {
        return view('pages.legal.accessibility');
    }
}
