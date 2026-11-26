@extends('layouts.site')
@section('title', 'Payment Options | Loving Arms Home Care, SPC')
@section('description', 'Straightforward information about private pay and Medicaid questions for non-medical home care in King and Pierce Counties, Washington.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Payment options</span></nav>
      <div class="eyebrow">Clear information first</div>
      <h1>Payment conversations without surprises.</h1>
      <p class="lead">Every family's situation is different. We will explain the information needed for an estimate and what still needs confirmation.</p>
    </div>
    <div class="page-hero-card"><strong>Private pay questions</strong><span>Medicaid status discussed honestly</span></div>
  </div>
</section>

<section>
  <div class="wrap two-col">
    <div class="panel">
      <div class="eyebrow">Ways to ask</div>
      <h2>Let's talk through your options.</h2>
      <p>Ask about private-pay arrangements or whether Medicaid-funded services may be relevant to your circumstances. We will not represent a service as covered until participation and authorization are confirmed.</p>
      <div class="notice amber">Medicaid coverage is not automatic. It generally depends on eligibility, assessment, authorization and provider participation. Our licensing application is awaiting approval, and we are not currently a Medicaid-participating provider.</div>
    </div>
    <div>
      <div class="eyebrow">What we can discuss</div>
      <h2 class="display">Transparent topics, step by step.</h2>
      <ul class="checklist">
        <li>Private-pay rates and minimum shifts</li>
        <li>The type and schedule of support needed</li>
        <li>Service-area and eligibility questions</li>
        <li>Medicaid and insurance questions to ask</li>
        <li>Service terms and cancellation expectations</li>
        <li>Provider status and required approvals</li>
      </ul>
      <div class="actions">
        <a class="btn btn-primary" href="{{ route('contact') }}">Ask about payment</a>
        <a class="btn btn-outline" href="{{ route('faq') }}">Read the FAQ</a>
      </div>
    </div>
  </div>
</section>

<section class="soft">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Payment notes</div>
      <h2>Questions worth asking any provider</h2>
      <p>These are the details we encourage families to confirm before care begins.</p>
    </div>
    <div class="faq-list">
      <details class="faq-item"><summary>How is the cost of care determined?</summary><p>Costs depend on the type of support, schedule and agreed plan. During an inquiry we can discuss the information needed for an estimate without asking you to send sensitive financial details through the website.</p></details>
      <details class="faq-item"><summary>Do I need a long-term contract?</summary><p>We will explain service terms, scheduling expectations and cancellation requirements before care begins. No agreement should be signed without a clear review of those terms.</p></details>
      <details class="faq-item"><summary>Can Medicaid or insurance cover services?</summary><p>Coverage depends on eligibility, assessment, authorization and provider participation. We will not represent a service as covered until participation and authorization are confirmed.</p></details>
      <details class="faq-item"><summary>When does payment information need to be shared?</summary><p>Share only what is needed for a conversation through the form. Detailed financial or identification information should be handled directly and securely, not in a public website message.</p></details>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Talk it through</div>
        <h2>Get the details before you decide.</h2>
        <p>Call <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a> or email <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a>. We aim to respond within {{ config('loving.response_time') }}.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Request information</a>
    </div>
  </div>
</section>
@endsection
