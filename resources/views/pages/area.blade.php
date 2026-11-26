@extends('layouts.site')
@section('title', 'Home Care in '.$area['name'].' | Loving Arms Home Care, SPC')
@section('description', 'Local home care information for '.$area['name'].', '.$area['county'].', including nearby communities and the support topics we can discuss.')
@section('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => config('loving.company'),
    'description' => 'Non-medical home care information and CNA staffing inquiries for '.$area['name'].' and surrounding communities.',
    'telephone' => config('loving.phone_digits'),
    'email' => config('loving.email'),
    'url' => route('home'),
    'areaServed' => [
        '@type' => 'City',
        'name' => $area['name'],
        'containedInPlace' => ['@type' => 'AdministrativeArea', 'name' => $area['county'].', Washington'],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>{{ $area['name'] }}</span></nav>
      <div class="eyebrow">{{ $area['county'] }}, Washington</div>
      <h1>Home care conversations in {{ $area['name'] }}.</h1>
      <p class="lead">If you are exploring support for yourself or a family member in {{ $area['name'] }}, start with a conversation about routines, preferences and next steps.</p>
    </div>
    <div class="page-hero-card"><strong>{{ $area['county'] }}</strong><span>Nearby: {{ $area['nearby'] }}</span></div>
  </div>
</section>

<section>
  <div class="wrap two-col">
    <div class="prose">
      <h2>Local support, practical questions.</h2>
      <p>We focus on {{ config('loving.service_area') }}. Families in {{ $area['name'] }} can ask about non-medical topics such as personal care, companionship, daily living support, respite planning and care coordination.</p>
      <p>Nearby communities we can discuss include {{ $area['nearby'] }}. Send your city or ZIP code in the inquiry form and we will confirm whether your location is within the service area we can discuss.</p>
      <p>Our licensing application is awaiting approval. Services begin only when required approvals, staffing and authorizations are in place.</p>
      <a class="btn btn-primary" href="{{ route('contact') }}">Ask about care in {{ $area['name'] }}</a>
    </div>
    <div class="panel">
      <div class="eyebrow">What to ask us</div>
      <h3>A good local conversation covers</h3>
      <ul class="checklist">
        <li>Whether your address is in the service area</li>
        <li>Which support topics match your routines</li>
        <li>What assessment and approvals may be required</li>
        <li>Expected scheduling and communication</li>
        <li>Private-pay and Medicaid questions</li>
      </ul>
    </div>
  </div>
</section>

<section class="soft">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Services to explore</div>
      <h2>Support topics near {{ $area['name'] }}</h2>
      <p>Availability depends on assessment, staffing, approvals and the agreed plan.</p>
    </div>
    <div class="cards">
      @foreach(array_slice($services, 0, 6, true) as $slug => $service)
        <article class="card service-card">
          <div class="card-icon" aria-hidden="true">{{ $service['icon'] }}</div>
          <h3>{{ $service['title'] }}</h3>
          <p>{{ $service['short'] }}</p>
          <a class="card-link" href="{{ route('services.show', $slug) }}">Explore {{ $service['title'] }} →</a>
        </article>
      @endforeach
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Nearby areas</div>
      <h2>Other communities we discuss</h2>
      <p>Choose a nearby area to see local context and service links.</p>
    </div>
    <div class="cards four">
      @foreach($areas as $areaSlug => $otherArea)
        @continue($areaSlug === $slug)
        <a class="card" href="{{ route('areas.show', $areaSlug) }}">
          <h3>{{ $otherArea['name'] }}</h3>
          <p>{{ $otherArea['county'] }} · {{ $otherArea['nearby'] }}</p>
          <span class="card-link">View local information →</span>
        </a>
      @endforeach
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Start locally</div>
        <h2>Let's talk about your situation in {{ $area['name'] }}.</h2>
        <p>Call <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a> or send an inquiry. We aim to respond within {{ config('loving.response_time') }}.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Contact us</a>
    </div>
  </div>
</section>
@endsection
