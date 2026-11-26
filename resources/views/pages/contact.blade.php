@extends('layouts.site')
@section('title', 'Contact | Loving Arms Home Care, SPC')
@section('description', 'Contact Loving Arms Home Care, SPC about home care, payment questions, your service area or facility staffing. We aim to respond within one business day.')
@section('content')
@php
    $relationshipValues = \App\Models\Inquiry::RELATIONSHIPS;
    $relationshipOptions = array_values($relationshipValues) === $relationshipValues ? array_combine($relationshipValues, $relationshipValues) : $relationshipValues;
    $urgencyOptions = \App\Models\Inquiry::URGENCIES;
    $sourceOptions = \App\Models\Inquiry::SOURCES;
    $contactOptions = \App\Models\Inquiry::PREFERRED_CONTACT;
@endphp
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Contact</span></nav>
      <div class="eyebrow">Get in touch</div>
      <h1>Let's start with a conversation.</h1>
      <p class="lead">Tell us what kind of support or information you are looking for. We will listen and explain the next steps.</p>
    </div>
    <div class="page-hero-card"><strong>{{ config('loving.phone') }}</strong><span>We aim to respond within {{ config('loving.response_time') }}</span></div>
  </div>
</section>

<section class="soft">
  <div class="wrap contact-grid">
    <div class="contact-card">
      <h3>Contact Loving Arms</h3>
      <div class="contact-line"><strong>Phone</strong><a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a></div>
      <div class="contact-line"><strong>Email</strong><a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a></div>
      <div class="contact-line"><strong>Service area</strong>{{ config('loving.service_area') }}</div>
      <div class="contact-line"><strong>Response time</strong>We aim to respond within {{ config('loving.response_time') }}</div>
      <div class="notice amber page-notice">For emergencies, call 911. This website is not monitored as an emergency service.</div>
      <p><a class="card-link" href="{{ route('faq') }}">Read common questions →</a></p>
    </div>

    <div class="form-card">
      <h3>Send an inquiry</h3>
      <p>Choose the reason for your message and share only the details needed for a first conversation.</p>
      <form method="POST" action="{{ route('inquiry.store') }}" data-analytics="inquiry">
        @csrf
        @include('partials.errors')
        <div class="fields">
          @include('partials.field', ['name' => 'name', 'label' => 'Your name', 'required' => true, 'autocomplete' => 'name', 'placeholder' => 'Full name'])
          @include('partials.field', ['name' => 'phone', 'label' => 'Phone number', 'type' => 'tel', 'autocomplete' => 'tel', 'placeholder' => 'Best number to reach you'])
          @include('partials.field', ['name' => 'email', 'label' => 'Your email', 'type' => 'email', 'required' => true, 'full' => true, 'autocomplete' => 'email', 'placeholder' => 'you@example.com'])
          @include('partials.field', ['name' => 'topic', 'label' => 'I am contacting you about', 'type' => 'select', 'required' => true, 'full' => true, 'options' => array_combine(\App\Models\Inquiry::TOPICS, \App\Models\Inquiry::TOPICS)])
          @include('partials.field', ['name' => 'relationship', 'label' => 'Who is this care for?', 'type' => 'select', 'full' => true, 'value' => $for, 'options' => $relationshipOptions])
          @include('partials.field', ['name' => 'zip', 'label' => 'ZIP code', 'autocomplete' => 'postal-code'])
          @include('partials.field', ['name' => 'urgency', 'label' => 'Timing', 'type' => 'select', 'options' => $urgencyOptions])
          @include('partials.field', ['name' => 'source', 'label' => 'How did you hear about us?', 'type' => 'select', 'options' => $sourceOptions])
          @include('partials.field', ['name' => 'preferred_contact', 'label' => 'Preferred contact method', 'type' => 'select', 'options' => $contactOptions])
          @include('partials.field', ['name' => 'message', 'label' => 'How can we help?', 'type' => 'textarea', 'required' => true, 'full' => true, 'placeholder' => 'Share a little about the support or information you need. Please do not include sensitive medical or financial information.'])
          <div class="field full">
            <label class="check"><input type="checkbox" name="consent" value="1" @checked(old('consent')) required><span>I agree to be contacted about this inquiry and understand that sharing information here does not create a service agreement.</span></label>
            @error('consent')<span class="err">Please confirm to continue.</span>@enderror
          </div>
          <div class="hp" aria-hidden="true"><label>Website <input name="website" tabindex="-1" autocomplete="off"></label></div>
          <div class="field full"><button class="btn btn-primary" type="submit">Send inquiry</button></div>
        </div>
        <small>We aim to respond within {{ config('loving.response_time') }}. Do not send sensitive medical, financial or identification details through this form. For emergencies, call 911.</small>
      </form>
    </div>
  </div>
</section>
@endsection
