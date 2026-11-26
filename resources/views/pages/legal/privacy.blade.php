@extends('layouts.site')
@section('title', 'Privacy Policy | Loving Arms Home Care, SPC')
@section('description', 'Plain-language information about what Loving Arms collects through its website and how to ask questions about your information.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Privacy</span></nav>
      <div class="eyebrow">Legal</div>
      <h1>Privacy policy.</h1>
      <p class="lead">A plain-language description of the information this website collects and how to reach us with questions.</p>
    </div>
    <div class="page-hero-card"><strong>Last updated</strong><span>November 25, 2026</span></div>
  </div>
</section>

<section>
  <div class="legal">
    <div class="prose">
      <h2>What this policy covers</h2>
      <p>This policy describes information submitted through the forms on this website and standard technical information created when you visit. It applies to {{ config('loving.company') }} and this website only.</p>

      <h3>Information you may provide</h3>
      <ul>
        <li><strong>Contact inquiries:</strong> name, email address, phone number and the details you choose to include in an inquiry, such as topic, relationship, location and timing.</li>
        <li><strong>Applications:</strong> name, phone, email, city, role interest, experience, availability, credentials, references, resume and messages submitted through the careers form.</li>
        <li><strong>Facility staffing requests:</strong> facility name and type, contact name, phone, email, roles needed, shifts, desired start date and messages.</li>
        <li><strong>Other messages:</strong> information you send us directly by phone or email when you choose to contact us.</li>
      </ul>

      <h3>Information collected automatically</h3>
      <p>Standard server logs and website analytics, when enabled, may record details such as IP address, browser type, pages requested and timestamps. These records help us operate and improve the site.</p>

      <h3>How we use information</h3>
      <p>We use submitted information to respond to you, understand your question, evaluate an application or staffing request, keep records of communications and improve the information on this website. We do not sell information submitted through this website.</p>

      <h3>Please do not submit sensitive information here</h3>
      <p>Do not send Social Security numbers, dates of birth, financial account details, medical records, patient or resident information, or other sensitive details through the website forms. Share such details only in an appropriate, direct conversation where we can explain how they will be handled.</p>

      <h3>Retention and access</h3>
      <p>We keep information only as long as it is useful for responding to you and for our records. If you would like to ask about information you submitted, request a correction or ask us to remove it, contact us using the details below. We will consider each request and explain what we can do.</p>

      <h3>Third-party links</h3>
      <p>This site may link to other websites. Their privacy practices are their own, and this policy does not apply to them.</p>

      <h3>Questions?</h3>
      <p>Contact us with any privacy question: <a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a>, <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a> or through the <a href="{{ route('contact') }}">contact form</a>. You can also read our <a href="{{ route('privacy-practices') }}">Privacy practices</a> and <a href="{{ route('terms') }}">Terms</a>.</p>
    </div>
  </div>
</section>
@endsection
