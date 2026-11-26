@extends('layouts.site')
@section('title', 'Careers | Loving Arms Home Care, SPC')
@section('description', 'Explore caregiver, CNA, companion and facility staffing roles and submit an application of interest to Loving Arms Home Care, SPC.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Careers</span></nav>
      <div class="eyebrow">Work with purpose</div>
      <h1>Careers built around respect.</h1>
      <p class="lead">We welcome interest from compassionate caregivers and qualified nursing assistants who value dignity, reliability and person-centered support.</p>
    </div>
    <div class="page-hero-card"><strong>Four role areas</strong><span>Interest applications, not a job offer</span></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Where you could fit</div>
      <h2>Roles we discuss</h2>
      <p>Choose the area closest to your experience. We will talk through the details during screening.</p>
    </div>
    <div class="role-grid">
      @foreach($roles as $role)
        <article class="role-card">
          <div class="card-icon" aria-hidden="true">{{ $role['icon'] }}</div>
          <h3>{{ $role['title'] }}</h3>
          <p>{{ $role['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>

<section class="soft">
  <div class="wrap two-col">
    <div>
      <div class="eyebrow">What we will cover</div>
      <h2 class="display">Clear expectations from the start.</h2>
      <ul class="checklist">
        <li>Role duties, orientation and supervision</li>
        <li>Required credentials, references and background checks</li>
        <li>Availability, service area and scheduling questions</li>
        <li>Pay, scheduling details and benefit information shared during screening and confirmed before any assignment</li>
      </ul>
      <div class="notice page-notice">Submitting an interest application does not create an offer of employment. Our licensing application is awaiting approval, and assignments begin only when all requirements are in place.</div>
    </div>
    <div class="panel">
      <div class="eyebrow">Three steps</div>
      <h3>How the process works</h3>
      <div class="steps">
        <div class="step"><div class="num">01</div><h3>Introduce yourself</h3><p>Tell us about your experience, availability and preferred role.</p></div>
        <div class="step"><div class="num">02</div><h3>Share qualifications</h3><p>Discuss credentials, references and any required checks.</p></div>
        <div class="step"><div class="num">03</div><h3>Connect with us</h3><p>We will share next steps if a suitable opportunity is available.</p></div>
      </div>
    </div>
  </div>
</section>

<section id="apply">
  <div class="wrap form-card">
    <h3>Apply / express interest</h3>
    <p>Share your experience and availability. Please do not include a Social Security number, date of birth or financial information.</p>
    <form method="POST" action="{{ route('application.store') }}" data-analytics="application" enctype="multipart/form-data">
      @csrf
      @include('partials.errors')
      <div class="fields">
        @include('partials.field', ['name' => 'name', 'label' => 'Full name', 'required' => true, 'autocomplete' => 'name'])
        @include('partials.field', ['name' => 'phone', 'label' => 'Phone', 'type' => 'tel', 'required' => true, 'autocomplete' => 'tel'])
        @include('partials.field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'autocomplete' => 'email'])
        @include('partials.field', ['name' => 'city', 'label' => 'City', 'autocomplete' => 'address-level2'])
        @include('partials.field', ['name' => 'role_applied', 'label' => 'Role you are interested in', 'type' => 'select', 'required' => true, 'full' => true, 'options' => array_combine(\App\Models\Application::ROLES, \App\Models\Application::ROLES)])
        @include('partials.field', ['name' => 'years_experience', 'label' => 'Years of experience', 'type' => 'number', 'required' => true, 'value' => 0])
        @include('partials.field', ['name' => 'availability', 'label' => 'Availability', 'type' => 'textarea', 'required' => true, 'full' => true, 'placeholder' => 'Days and times, day / evening / overnight, areas you can travel to (King / Pierce County)'])
        @include('partials.field', ['name' => 'credentials', 'label' => 'Credentials and certifications', 'type' => 'textarea', 'required' => true, 'full' => true, 'placeholder' => 'e.g. Nursing Assistant Certified (NAC), Home Care Aide certification, CPR / First Aid, with expiry dates'])
        @include('partials.field', ['name' => 'references_info', 'label' => 'Two professional references', 'type' => 'textarea', 'required' => true, 'full' => true, 'placeholder' => 'Name, relationship, phone or email'])
        @include('partials.field', ['name' => 'resume', 'label' => 'Resume (optional)', 'type' => 'file', 'full' => true, 'accept' => '.pdf,.doc,.docx'])
        <div class="field full"><small>PDF, DOC or DOCX only, up to 5 MB.</small></div>
        @include('partials.field', ['name' => 'message', 'label' => 'Anything else you would like us to know?', 'type' => 'textarea', 'full' => true])
        <div class="field full">
          <label class="check"><input type="checkbox" name="consent" value="1" @checked(old('consent')) required><span>I confirm the information is accurate and I agree to be contacted about opportunities. I understand credential, reference and background checks may be required.</span></label>
          @error('consent')<span class="err">Please confirm to continue.</span>@enderror
        </div>
        <div class="hp" aria-hidden="true"><label>Website <input name="website" tabindex="-1" autocomplete="off"></label></div>
        <div class="field full"><button class="btn btn-primary" type="submit">Submit application</button></div>
      </div>
      <small>We aim to respond within {{ config('loving.response_time') }}. Information you share is used to discuss opportunities and is handled respectfully.</small>
    </form>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="notice">Loving Arms Home Care, SPC is an equal opportunity employer. We consider applicants without regard to race, color, religion, sex, sexual orientation, gender identity, national origin, age, disability, veteran status or any other characteristic protected by applicable law.</div>
  </div>
</section>
@endsection
