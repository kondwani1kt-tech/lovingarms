@extends('layouts.site')
@section('title', 'Privacy Practices | Loving Arms Home Care, SPC')
@section('description', 'How Loving Arms approaches information shared during care conversations, without claiming legal or HIPAA compliance.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Privacy practices</span></nav>
      <div class="eyebrow">Legal</div>
      <h1>Privacy practices.</h1>
      <p class="lead">How we approach information shared during conversations about care and staffing.</p>
    </div>
    <div class="page-hero-card"><strong>Last updated</strong><span>November 25, 2026</span></div>
  </div>
</section>

<section>
  <div class="legal">
    <div class="prose">
      <h2>Our approach</h2>
      <p>When families talk with us about care, they often share personal details about daily routines, preferences and health. We treat those details respectfully and aim to limit what is shared to the people who need it to continue the conversation.</p>

      <h3>During care conversations</h3>
      <ul>
        <li>We ask for the information needed to understand the support being discussed.</li>
        <li>We confirm with the client or authorized representative who should be included in updates.</li>
        <li>We keep conversation notes focused on planning and scheduling.</li>
        <li>We ask you to raise privacy preferences at the start of a conversation.</li>
      </ul>

      <h3>Important limitations</h3>
      <p>This page is a general description of our practices. It is not a claim of compliance with HIPAA or any other specific privacy law or standard. If you need formal privacy terms for a healthcare relationship, ask us before sharing details so we can explain what applies in your situation.</p>
      <p>The website contact form is for general inquiries only. Please do not submit medical records, patient or resident information, financial details or identification documents through it. For emergencies, call 911.</p>

      <h3>Facility staffing conversations</h3>
      <p>When a facility contacts us about coverage, we discuss roles, shifts and requirements. Please do not include patient or resident information in a staffing request. Credential, reference and required checks are explained during the screening process.</p>

      <h3>Questions?</h3>
      <p>If you want to know how a particular piece of information will be handled, ask before you share it. Call <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a>, email <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a> or use the <a href="{{ route('contact') }}">contact form</a>. For details about website information, see our <a href="{{ route('privacy') }}">Privacy policy</a>.</p>
    </div>
  </div>
</section>
@endsection
