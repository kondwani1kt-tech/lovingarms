@extends('layouts.site')
@section('title', 'Accessibility | Loving Arms Home Care, SPC')
@section('description', 'How to request help accessing information on the Loving Arms Home Care website or ask for information in another format.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Accessibility</span></nav>
      <div class="eyebrow">Legal</div>
      <h1>Accessibility.</h1>
      <p class="lead">We want families and facility partners to be able to reach the information they need.</p>
    </div>
    <div class="page-hero-card"><strong>Last updated</strong><span>November 25, 2026</span></div>
  </div>
</section>

<section>
  <div class="legal">
    <div class="prose">
      <h2>Our commitment</h2>
      <p>We aim to keep this website readable, keyboard friendly and clear to use on common devices and browsers. We review pages as we add content, and we treat accessibility feedback as a chance to improve.</p>
      <p>This page does not claim conformance with a specific technical standard. If something on the site is difficult to use, tell us what happened and we will work with you to provide the information another way.</p>

      <h3>How to request help</h3>
      <p>Use any of the following routes and describe the page, document or task you are trying to complete:</p>
      <ul>
        <li>Call <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a></li>
        <li>Email <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a></li>
        <li>Send a message through the <a href="{{ route('contact') }}">contact form</a></li>
      </ul>
      <p>We aim to respond within {{ config('loving.response_time') }}. If you need information in a different format, such as a printable document or a verbal explanation, let us know and we will discuss what we can provide.</p>

      <h3>Questions?</h3>
      <p>For questions about this page or any accessibility barrier you encountered, contact us using the details above. You may also review our <a href="{{ route('privacy') }}">Privacy policy</a> and <a href="{{ route('terms') }}">Terms</a>.</p>
    </div>
  </div>
</section>
@endsection
