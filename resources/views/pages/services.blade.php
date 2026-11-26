@extends('layouts.site')
@section('title', 'Home Care Services | Loving Arms Home Care, SPC')
@section('description', 'Explore non-medical home care services: personal care, companionship, daily living support, respite, memory support and more in King and Pierce Counties.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Services</span></nav>
      <div class="eyebrow">How we can help</div>
      <h1>Practical support for everyday life.</h1>
      <p class="lead">Explore the types of non-medical support we can discuss. Availability depends on assessment, staffing, applicable approvals and the agreed plan of care.</p>
    </div>
    <div class="page-hero-card"><strong>{{ count($services) }} care topics</strong><span>Choose what sounds closest to your needs</span></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head left">
      <div class="eyebrow">Our services</div>
      <h2>Support shaped around the person</h2>
      <p>Each card explains the plain outcome we are aiming for. Open a service to see what it may include and when it may fit.</p>
    </div>
    <div class="cards">
      @foreach($services as $slug => $service)
        <article class="card service-card">
          <div class="card-icon" aria-hidden="true">{{ $service['icon'] }}</div>
          <h3>{{ $service['title'] }}</h3>
          <p>{{ $service['short'] }}</p>
          <a class="card-link" href="{{ route('services.show', $slug) }}">Explore {{ $service['title'] }} →</a>
        </article>
      @endforeach
    </div>
    <div class="notice page-notice"><strong>Before care begins:</strong> our licensing application is awaiting approval. Services start only when required approvals, registrations, staffing and authorizations are in place. We do not provide skilled nursing or medical treatment.</div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Not sure where to start?</div>
        <h2>Begin with a conversation.</h2>
        <p>Tell us about the routines, preferences and concerns that matter most. We will help you identify the right questions to ask.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Request a consultation</a>
    </div>
  </div>
</section>
@endsection
