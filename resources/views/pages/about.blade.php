@extends('layouts.site')
@section('title', 'About Us | Loving Arms Home Care, SPC')
@section('description', 'Learn about the mission, values and current licensing status of Loving Arms Home Care, SPC, serving King and Pierce Counties, Washington.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>About us</span></nav>
      <div class="eyebrow">About Loving Arms</div>
      <h1>A little more care. A lot more peace of mind.</h1>
      <p>Loving Arms Home Care, SPC is being built around a simple belief: every person deserves kindness, patience and respect in the place they call home.</p>
    </div>
    <div class="page-hero-card"><strong>Clear, calm conversations</strong><span>From the first question to the next step</span></div>
  </div>
</section>

<section>
  <div class="wrap two-col">
    <div class="prose">
      <div class="eyebrow">Our story and mission</div>
      <h2>Starting with the person, not a checklist.</h2>
      <p>Families often contact us at a crossroads: a parent needs more help, a spouse is tired, or a loved one is coming home after a change in health. Our role is to listen first, explain what we can discuss and be honest about what still needs to be confirmed.</p>
      <p>Our focus is non-medical support that helps people maintain comfort, routines and independence, alongside practical communication for the family members around them.</p>
      <p>We are careful with language: a conversation is not a promise of service, coverage or authorization. We would rather give a realistic answer than an optimistic one we cannot stand behind.</p>
      <a class="btn btn-primary" href="{{ route('contact') }}">Talk with our team</a>
    </div>
    <div class="panel">
      <div class="eyebrow">What we value</div>
      <h2>Care with heart, delivered with respect.</h2>
      <ul class="checklist">
        <li>Listen to each person and their family</li>
        <li>Respect personal choices, culture and routines</li>
        <li>Communicate clearly and thoughtfully</li>
        <li>Support dignity, comfort and independence</li>
        <li>Be honest about scope, status and availability</li>
      </ul>
    </div>
  </div>
</section>

<section class="soft">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">How we work</div>
      <h2>Our commitments in practice</h2>
      <p>These are the standards we ask families and facility partners to hold us to.</p>
    </div>
    <div class="cards">
      <article class="card"><div class="card-icon" aria-hidden="true">♡</div><h3>Compassion</h3><p>We treat every person with kindness, empathy and patience.</p></article>
      <article class="card"><div class="card-icon" aria-hidden="true">✦</div><h3>Dignity</h3><p>We respect privacy, preferences, culture and individual choice.</p></article>
      <article class="card"><div class="card-icon" aria-hidden="true">⌂</div><h3>Reliability</h3><p>We value clear communication and dependable, accountable practice.</p></article>
      <article class="card"><div class="card-icon" aria-hidden="true">☾</div><h3>Honesty</h3><p>We explain requirements and never represent unconfirmed coverage or status.</p></article>
      <article class="card"><div class="card-icon" aria-hidden="true">＋</div><h3>Collaboration</h3><p>We include the client or authorized representative in planning.</p></article>
      <article class="card"><div class="card-icon" aria-hidden="true">☕</div><h3>Community</h3><p>We focus our attention on families and facilities in our local service area.</p></article>
    </div>
    <div class="notice page-notice"><strong>Current business status:</strong> Our licensing application has been submitted and is awaiting approval. Loving Arms Home Care, SPC is not currently represented as licensed or approved to provide regulated home care services or to participate in Medicaid. Services and staffing assignments will begin only when all applicable licensing, registrations, contracts and authorizations are in place.</div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Next step</div>
        <h2>Let us listen to your situation.</h2>
        <p>Ask about services, payment questions, your area or facility staffing. We aim to respond within {{ config('loving.response_time') }}.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Contact us</a>
    </div>
  </div>
</section>
@endsection
