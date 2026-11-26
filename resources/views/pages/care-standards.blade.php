@extends('layouts.site')
@section('title', 'Our Care Standards | Loving Arms Home Care, SPC')
@section('description', 'Learn about the care standards Loving Arms uses to guide conversations, planning, verification, communication and review.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Care standards</span></nav>
      <div class="eyebrow">How we hold ourselves</div>
      <h1>Standards you can ask about.</h1>
      <p class="lead">Clear expectations matter. These six commitments guide how we discuss support with families and facilities.</p>
    </div>
    <div class="page-hero-card"><strong>Six commitments</strong><span>From first conversation to review</span></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="cards">
      @foreach(config('loving.standards') as $standard)
        <article class="card">
          <div class="card-icon" aria-hidden="true">{{ $standard['icon'] }}</div>
          <h3>{{ $standard['title'] }}</h3>
          <p>{{ $standard['text'] }}</p>
        </article>
      @endforeach
    </div>
    <div class="notice page-notice">These standards describe how we approach conversations and planning. They are not a guarantee of service availability, coverage or authorization. Our licensing application is awaiting approval.</div>
  </div>
</section>

<section class="soft">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">How we put them into practice</div>
      <h2>Verification, communication and review</h2>
      <p>Ask us how each of these applies to the specific service you are discussing.</p>
    </div>
    <div class="cards">
      <article class="card">
        <div class="card-icon" aria-hidden="true">01</div>
        <h3>Verification</h3>
        <p>Credential, reference and required background checks are part of the hiring process before assignments. We will explain which checks apply and when they must be complete.</p>
      </article>
      <article class="card">
        <div class="card-icon" aria-hidden="true">02</div>
        <h3>Communication</h3>
        <p>Updates and a point of contact are agreed with the client or authorized representative, respecting privacy preferences and who should be included.</p>
      </article>
      <article class="card">
        <div class="card-icon" aria-hidden="true">03</div>
        <h3>Review</h3>
        <p>Needs change. We plan for regular review and adjustment of the agreed support, and we explain how to raise a concern if something is not working.</p>
      </article>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Questions are welcome</div>
        <h2>Ask how we meet these standards.</h2>
        <p>We would rather explain the details than leave you guessing. Read our FAQ or contact us with a specific question.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Ask a question</a>
    </div>
  </div>
</section>
@endsection
