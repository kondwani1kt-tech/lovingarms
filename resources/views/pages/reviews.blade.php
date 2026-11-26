@extends('layouts.site')
@section('title', 'Reviews & Feedback | Loving Arms Home Care, SPC')
@section('description', 'How families and facility partners can share feedback with Loving Arms Home Care, SPC. No unverified testimonials are published here.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Reviews &amp; feedback</span></nav>
      <div class="eyebrow">Your voice matters</div>
      <h1>Feedback helps us do better.</h1>
      <p class="lead">We would rather hear honestly from families and facility partners than publish claims we cannot verify.</p>
    </div>
    <div class="page-hero-card"><strong>No invented reviews</strong><span>Real feedback, shared the right way</span></div>
  </div>
</section>

<section>
  <div class="wrap">
    @if(empty($reviews))
      <div class="panel">
        <div class="eyebrow">Published feedback</div>
        <h2>No reviews are published here yet.</h2>
        <p>We do not publish invented, purchased or unverified testimonials. Once families choose to share feedback through the appropriate channel, we can consider adding it with their permission.</p>
        <p>If you have worked with us and would like to leave a review, contact us and ask for the direct review link. We will provide the correct link rather than guessing where feedback should go.</p>
        <div class="actions">
          <a class="btn btn-primary" href="{{ route('contact', ['for' => 'other']) }}">Share feedback</a>
          <a class="btn btn-outline" href="{{ route('care-standards') }}">See our care standards</a>
        </div>
      </div>
    @else
      <div class="review-grid">
        @foreach($reviews as $review)
          <article class="review-card">
            <blockquote>{{ $review['quote'] ?? $review['text'] ?? $review['body'] ?? '' }}</blockquote>
            <cite>{{ $review['author'] ?? $review['name'] ?? 'Shared feedback' }}</cite>
          </article>
        @endforeach
      </div>
    @endif
  </div>
</section>

<section class="soft">
  <div class="wrap two-col">
    <div class="panel">
      <div class="eyebrow">How to leave feedback</div>
      <h2>Tell us how we are doing.</h2>
      <ul class="checklist">
        <li>Contact us and ask for the direct review link</li>
        <li>Tell us whether the feedback is about home care or facility staffing</li>
        <li>Let us know if you would like your name withheld</li>
        <li>Share concerns privately so we can respond and improve</li>
      </ul>
    </div>
    <div class="prose">
      <h3>We read concerns too</h3>
      <p>Feedback is not only about praise. If something did not meet your expectations, please tell us what happened so we can review it. We aim to respond within {{ config('loving.response_time') }}.</p>
      <p>For urgent scheduling issues, call <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a>. For emergencies, call 911.</p>
      <a class="btn btn-primary" href="{{ route('contact', ['for' => 'other']) }}">Share feedback</a>
    </div>
  </div>
</section>
@endsection
