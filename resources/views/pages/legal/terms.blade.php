@extends('layouts.site')
@section('title', 'Terms of Use | Loving Arms Home Care, SPC')
@section('description', 'General terms for using the Loving Arms Home Care website and the limits of the information published here.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Terms</span></nav>
      <div class="eyebrow">Legal</div>
      <h1>Terms of use.</h1>
      <p class="lead">Plain-language terms for using this website and understanding what it does and does not promise.</p>
    </div>
    <div class="page-hero-card"><strong>Last updated</strong><span>November 25, 2026</span></div>
  </div>
</section>

<section>
  <div class="legal">
    <div class="prose">
      <h2>Using this website</h2>
      <p>By using this website, you agree to use it for lawful purposes and to provide accurate contact information when you choose to send us a message. You are responsible for the information you submit.</p>

      <h3>Informational only</h3>
      <p>Content here describes topics we can discuss. It is general information, not medical, legal or financial advice. Clinical decisions should be made with qualified health professionals.</p>

      <h3>No guarantee of services</h3>
      <p>Nothing on this website guarantees that a service, caregiver, schedule, rate, authorization or coverage is available. Services begin only after assessment, staffing, applicable approvals and the agreed plan are in place. Our licensing application is awaiting approval, and we do not currently represent Loving Arms as licensed or approved to provide regulated home care services or to participate in Medicaid.</p>

      <h3>Forms and communications</h3>
      <p>Sending an inquiry, application or staffing request does not create a service agreement, employment offer or contract. We will confirm scope, terms and requirements directly with you. Do not submit sensitive personal, medical, financial or patient information through the forms.</p>

      <h3>Links and changes</h3>
      <p>Links to other websites are provided for convenience, and we do not control their content. We may update the information or these terms as our practices change. The current version is the one published on this page.</p>

      <h3>Questions?</h3>
      <p>If you have a question about these terms, contact us at <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a>, <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a> or through the <a href="{{ route('contact') }}">contact form</a>. See also our <a href="{{ route('privacy') }}">Privacy policy</a> and <a href="{{ route('accessibility') }}">Accessibility</a> page.</p>
    </div>
  </div>
</section>
@endsection
