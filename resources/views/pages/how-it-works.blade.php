@extends('layouts.site')
@section('title', 'How It Works | Loving Arms Home Care, SPC')
@section('description', 'See how home care starts with Loving Arms: a practical four-step process of listening, reviewing requirements, agreeing on a plan and reviewing support.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>How it works</span></nav>
      <div class="eyebrow">A clear path forward</div>
      <h1>From first question to a plan that fits.</h1>
      <p class="lead">A practical four-step process built around listening, honest requirements and regular review.</p>
    </div>
    <div class="page-hero-card"><strong>Four clear steps</strong><span>No assumptions and no pressure</span></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="process">
      <div class="process-item"><div class="process-num">01</div><h3>Share your situation</h3><p>Call, email or send an inquiry. Tell us about routines, preferences, location and the kind of support you have in mind.</p></div>
      <div class="process-item"><div class="process-num">02</div><h3>Review requirements</h3><p>We discuss needs, service area, assessment questions, applicable approvals and any authorization requirements.</p></div>
      <div class="process-item"><div class="process-num">03</div><h3>Agree on the plan</h3><p>Schedule, caregiver match, communication and service terms are reviewed with the client or authorized representative before care begins.</p></div>
      <div class="process-item"><div class="process-num">04</div><h3>Review and adjust</h3><p>Once support begins, agreed check-ins and reviews keep the plan aligned with changing needs and preferences.</p></div>
    </div>
    <div class="notice page-notice"><strong>Important:</strong> a conversation does not guarantee service availability, licensing status, coverage or authorization. Our licensing application is awaiting approval. Services begin only when all required approvals are in place. This website is not monitored for emergencies; call 911 for urgent help.</div>
  </div>
</section>

<section class="soft">
  <div class="wrap two-col">
    <div class="panel">
      <div class="eyebrow">Before you contact us</div>
      <h2>A few useful notes</h2>
      <ul class="checklist">
        <li>Write down the daily routines that matter most</li>
        <li>Note which tasks have become difficult or tiring</li>
        <li>Think about preferred days and times</li>
        <li>Decide who should be included in updates</li>
        <li>Prepare questions about rates, coverage and terms</li>
      </ul>
    </div>
    <div class="prose">
      <h3>What we will confirm together</h3>
      <p>We will explain what is within our scope, what requires qualified clinical providers and which details must be confirmed before services can start. If a need is outside our scope, we can help identify the right questions to ask elsewhere.</p>
      <p>Do not send sensitive medical, financial or identification details through the website form. Those details belong in a direct, appropriate conversation.</p>
      <a class="btn btn-primary" href="{{ route('contact') }}">Start the conversation</a>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Ready when you are</div>
        <h2>A realistic next step starts with one call.</h2>
        <p>We aim to respond within {{ config('loving.response_time') }}. Reach us at <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a> or use the inquiry form.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Contact us</a>
    </div>
  </div>
</section>
@endsection
