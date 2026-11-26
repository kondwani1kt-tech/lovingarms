@extends('layouts.site')
@section('title', 'Family Care Resources | Loving Arms Home Care, SPC')
@section('description', 'A practical family care planning checklist and questions to ask before choosing home care support in King and Pierce Counties.')
@section('content')
<section class="page-hero">
  <div class="wrap page-hero-in">
    <div>
      <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Family resources</span></nav>
      <div class="eyebrow">Prepare for the conversation</div>
      <h1>A better plan starts with better questions.</h1>
      <p class="lead">Use this guide to organize your thoughts before you contact any care provider.</p>
    </div>
    <div class="page-hero-card"><strong>Planning checklist</strong><span>Six sections to help you prepare</span></div>
  </div>
</section>

<section>
  <div class="wrap two-col">
    <div class="panel">
      <div class="eyebrow">Downloadable guide</div>
      <h2>Family Care Planning Checklist</h2>
      <p>A short, printable guide covering daily routines, preferences, scheduling, payment, emergency planning and questions to ask any provider.</p>
      <a class="download-link" href="{{ asset('downloads/family-care-planning-checklist.txt') }}" download>↓ Download the checklist</a>
      <div class="notice page-notice">Please do not include sensitive medical, financial or identification details in a website form. Share those details directly in an appropriate conversation.</div>
    </div>
    <div class="prose">
      <h3>How to use this page</h3>
      <p>Work through the sections below with the person receiving care and the family members who will be involved. Bring your notes to the conversation. A written list makes it easier to compare options and spot missing information.</p>
      <p>These resources are general information, not medical, legal or financial advice. For clinical decisions, speak with qualified health professionals.</p>
    </div>
  </div>
</section>

<section class="soft">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Planning sections</div>
      <h2>What to think about first</h2>
      <p>Each section reflects a topic from the downloadable checklist.</p>
    </div>
    @php
      $sections = [
          ['Daily routines', 'When does the person wake, eat and sleep? Which tasks are difficult, and are there fall risks or home safety concerns?'],
          ['Preferences and dignity', 'What matters most about care at home? Are there cultural, language or privacy preferences? Who should be included in updates?'],
          ['Schedule and coverage', 'Is support occasional, weekly, overnight or short-term respite? What days and times matter most, and what is the backup plan?'],
          ['Payment and authorization', 'Are you discussing private pay, Medicaid questions or facility staffing? Which eligibility and authorization questions need answers?'],
          ['Emergency planning', 'Emergencies: call 911. Identify a family contact for urgent scheduling concerns and share health notes directly with qualified providers.'],
          ['Questions to ask any provider', 'Ask about licensing or approval, screening and supervision, backup coverage, rates and terms, and how care plans are reviewed.'],
      ];
    @endphp
    <div class="resources-grid">
      @foreach($sections as $section)
        <article class="resource-card">
          <div class="card-icon" aria-hidden="true">✦</div>
          <h3>{{ $section[0] }}</h3>
          <p>{{ $section[1] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band">
      <div>
        <div class="eyebrow">Put your notes to work</div>
        <h2>Bring your questions to us.</h2>
        <p>We will listen, explain what we can discuss and tell you honestly when a question needs a qualified professional.</p>
      </div>
      <a class="btn btn-light" href="{{ route('contact') }}">Contact us</a>
    </div>
  </div>
</section>
@endsection
