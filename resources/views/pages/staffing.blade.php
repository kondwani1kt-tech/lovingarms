@extends('layouts.site')
@section('title', 'Facility Staffing | Loving Arms Home Care, SPC')
@section('description', 'CNA and caregiver staffing inquiries for healthcare facilities in King and Pierce Counties, Washington. Confirm requirements before any assignment.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Facility staffing</span></nav>
      <div class="eyebrow">For healthcare facilities</div>
      <h1>Staffing conversations, handled carefully.</h1>
      <p class="lead">Share your coverage needs. We will confirm credentials, scope, orientation, supervision, scheduling and contract terms before any assignment is accepted.</p>
    </div>
    <div class="page-hero-card"><strong>CNA &amp; caregiver coverage</strong><span>Requirements confirmed in advance</span></div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="staff">
      <div>
        <div class="eyebrow">Facility partners</div>
        <h2>Discuss coverage, shifts and requirements.</h2>
        <p>Administrators and staffing coordinators in {{ config('loving.service_area') }} can use this form to describe the support they need. Assignments begin only once all licensing, contracts and requirements are in place.</p>
      </div>
      <a class="btn" href="#facility-form">Discuss facility staffing</a>
    </div>
  </div>
</section>

<section id="facility-form">
  <div class="wrap form-card">
    <h3>Facility staffing request</h3>
    <p>Tell us about your coverage needs. We aim to respond within {{ config('loving.response_time') }}.</p>
    <form method="POST" action="{{ route('staffing.store') }}" data-analytics="staffing">
      @csrf
      @include('partials.errors')
      <div class="fields">
        @include('partials.field', ['name' => 'facility_name', 'label' => 'Facility / organization', 'required' => true, 'full' => true, 'autocomplete' => 'organization'])
        @include('partials.field', ['name' => 'facility_type', 'label' => 'Type of facility', 'type' => 'select', 'required' => true, 'full' => true, 'options' => array_combine(\App\Models\StaffingRequest::FACILITY_TYPES, \App\Models\StaffingRequest::FACILITY_TYPES)])
        @include('partials.field', ['name' => 'contact_name', 'label' => 'Contact name', 'required' => true, 'autocomplete' => 'name'])
        @include('partials.field', ['name' => 'phone', 'label' => 'Phone', 'type' => 'tel', 'required' => true, 'autocomplete' => 'tel'])
        @include('partials.field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'full' => true, 'autocomplete' => 'email'])
        @include('partials.field', ['name' => 'roles_needed', 'label' => 'Roles needed', 'required' => true, 'full' => true, 'placeholder' => 'e.g. CNAs, caregivers'])
        @include('partials.field', ['name' => 'shifts_needed', 'label' => 'Shifts and coverage needed', 'type' => 'textarea', 'required' => true, 'full' => true, 'placeholder' => 'Days, day / evening / night / overnight, per-diem or scheduled, approximate hours per week'])
        @include('partials.field', ['name' => 'start_date', 'label' => 'Desired start date', 'type' => 'date'])
        @include('partials.field', ['name' => 'message', 'label' => 'Anything else we should know?', 'type' => 'textarea', 'full' => true])
        <div class="field full">
          <label class="check"><input type="checkbox" name="consent" value="1" @checked(old('consent')) required><span>I agree to be contacted about this staffing request and confirm I am authorized to share these facility details.</span></label>
          @error('consent')<span class="err">Please confirm to continue.</span>@enderror
        </div>
        <div class="hp" aria-hidden="true"><label>Website <input name="website" tabindex="-1" autocomplete="off"></label></div>
        <div class="field full"><button class="btn btn-primary" type="submit">Send staffing request</button></div>
      </div>
      <small>Do not include patient or resident information in this form. Information you share is used only to discuss the staffing request. See our <a href="{{ route('privacy') }}">Privacy</a> and <a href="{{ route('privacy-practices') }}">Privacy practices</a> pages for details.</small>
    </form>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="notice">Licensing, contracts and applicable requirements must be in place before assignments begin. For emergencies, call 911. General inquiries are reviewed during business hours.</div>
  </div>
</section>
@endsection
