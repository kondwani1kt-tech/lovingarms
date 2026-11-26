@extends('layouts.site')
@section('title', 'Frequently Asked Questions | Loving Arms Home Care, SPC')
@section('description', 'Answers to common questions about home care, licensing status, payment, scheduling, service areas and facility staffing.')
@section('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => collect($faqs)->map(function ($faq) {
        return [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
        ];
    })->values()->all(),
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>FAQ</span></nav>
      <div class="eyebrow">Answers, honestly</div>
      <h1>Frequently asked questions.</h1>
      <p class="lead">The topics families and facilities ask us most. If your question is not here, please get in touch.</p>
    </div>
    <div class="page-hero-card"><strong>{{ count($faqs) }} questions</strong><span>Select a question to read the answer</span></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="faq-list">
      @foreach($faqs as $faq)
        <details class="faq-item">
          <summary>{{ $faq['question'] }}</summary>
          <p>{{ $faq['answer'] }}</p>
        </details>
      @endforeach
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Still have questions?</div>
        <h2>Ask us directly.</h2>
        <p>We aim to respond within {{ config('loving.response_time') }}. Call <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a>, email <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a> or send a message.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Contact us</a>
    </div>
  </div>
</section>
@endsection
