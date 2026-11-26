@extends('layouts.site')
@section('title', $service['title'].' | Loving Arms Home Care, SPC')
@section('description', $service['short'].' Non-medical home care information for families in King and Pierce Counties, Washington.')
@section('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $service['title'],
    'description' => $service['lead'],
    'serviceType' => $service['title'],
    'provider' => [
        '@type' => 'LocalBusiness',
        'name' => config('loving.company'),
        'telephone' => config('loving.phone_digits'),
        'email' => config('loving.email'),
        'url' => route('home'),
    ],
    'areaServed' => [
        ['@type' => 'AdministrativeArea', 'name' => 'King County, Washington'],
        ['@type' => 'AdministrativeArea', 'name' => 'Pierce County, Washington'],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><a href="{{ route('services') }}">Services</a><span>/</span><span>{{ $service['title'] }}</span></nav>
      <div class="eyebrow">Home care service</div>
      <h1>{{ $service['title'] }}</h1>
      <p class="lead">{{ $service['short'] }}</p>
    </div>
    <div class="page-hero-card"><strong aria-hidden="true">{{ $service['icon'] }}</strong><span>Non-medical support, discussed with the family</span></div>
  </div>
</section>

<section>
  <div class="wrap two-col">
    <div class="panel">
      <div class="eyebrow">What this can look like</div>
      <h2>{{ $service['title'] }}</h2>
      <p>{{ $service['lead'] }}</p>
      <ul class="checklist">
        @foreach($service['includes'] as $item)
          <li>{{ $item }}</li>
        @endforeach
      </ul>
    </div>
    <div>
      <div class="card">
        <div class="eyebrow">May be a fit when</div>
        <h3>Every situation is different.</h3>
        <ul class="checklist">
          @foreach($service['good_for'] as $reason)
            <li>{{ $reason }}</li>
          @endforeach
        </ul>
      </div>
      <div class="notice page-notice">{{ $service['note'] }}</div>
      <div class="actions">
        <a class="btn btn-primary" href="{{ route('contact') }}">Ask about this service</a>
        <a class="btn btn-outline" href="{{ route('how-it-works') }}">How care starts</a>
      </div>
    </div>
  </div>
</section>

<section class="soft">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Keep exploring</div>
      <h2>Related support topics</h2>
      <p>Other areas we can discuss during an initial conversation.</p>
    </div>
    <div class="cards">
      @foreach(collect($services)->except($slug)->take(3) as $relatedSlug => $related)
        <article class="card service-card">
          <div class="card-icon" aria-hidden="true">{{ $related['icon'] }}</div>
          <h3>{{ $related['title'] }}</h3>
          <p>{{ $related['short'] }}</p>
          <a class="card-link" href="{{ route('services.show', $relatedSlug) }}">Explore {{ $related['title'] }} →</a>
        </article>
      @endforeach
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">A thoughtful first step</div>
        <h2>Tell us what you are noticing.</h2>
        <p>We will listen, explain next-step requirements and confirm what can be provided before anything begins. Our licensing application is awaiting approval.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Request a consultation</a>
    </div>
  </div>
</section>
@endsection
