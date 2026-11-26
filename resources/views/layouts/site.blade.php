<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('description', 'Loving Arms Home Care, SPC — person-centered home care information and CNA staffing inquiries for King and Pierce Counties, Washington.')">
<meta name="theme-color" content="#3f2b5b">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>document.documentElement.classList.add('js-reveal');</script>
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('loving.company') }}">
<meta property="og:title" content="@yield('title', 'Loving Arms Home Care, SPC | Care That Feels Like Family')">
<meta property="og:description" content="@yield('description', 'Person-centered home care information and CNA staffing inquiries for King and Pierce Counties, Washington.')">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary">
<link rel="canonical" href="{{ url()->current() }}">
<link rel="icon" href="{{ asset('favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('css/site.css') }}">
<title>@yield('title', 'Loving Arms Home Care, SPC | Care That Feels Like Family')</title>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => config('loving.company'),
    'description' => 'Home care information and CNA staffing inquiries for families and facilities in King and Pierce Counties, Washington.',
    'telephone' => config('loving.phone_digits'),
    'email' => config('loving.email'),
    'url' => route('home'),
    'areaServed' => ['King County, Washington', 'Pierce County, Washington'],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@yield('schema')
</head>
<body>
<a class="skip-link" href="#main">Skip to main content</a>
<div class="topbar">
  <div class="wrap topbar-inner">
    <div class="topbar-desktop">
      <span>Serving {{ config('loving.service_area') }}</span>
      <span>We aim to respond within {{ config('loving.response_time') }}</span>
      <span><a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a> · <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a></span>
    </div>
    @php
      $socials = [
          'linkedin' => ['label' => 'LinkedIn', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.5 8.5H3V21h3.5V8.5ZM4.75 3a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM21 13.8c0-3-1.6-4.4-3.7-4.4-1.7 0-2.5.9-2.9 1.6V8.5H11V21h3.4v-6.3c0-1.7.8-2.7 2.1-2.7 1.3 0 1.8 1 1.8 2.7V21H21v-7.2Z"/></svg>'],
          'facebook' => ['label' => 'Facebook', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.3-1.5 1.6-1.5h1.7V3.6c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.1H7.4V13h2.7v8h3.4Z"/></svg>'],
          'instagram' => ['label' => 'Instagram', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.2 2h9.6A5.2 5.2 0 0 1 22 7.2v9.6a5.2 5.2 0 0 1-5.2 5.2H7.2A5.2 5.2 0 0 1 2 16.8V7.2A5.2 5.2 0 0 1 7.2 2Zm0 2A3.2 3.2 0 0 0 4 7.2v9.6A3.2 3.2 0 0 0 7.2 20h9.6a3.2 3.2 0 0 0 3.2-3.2V7.2A3.2 3.2 0 0 0 16.8 4H7.2Zm5 3a4.8 4.8 0 1 1 0 9.6 4.8 4.8 0 0 1 0-9.6Zm0 2a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6Zm6.1-2.8a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4Z"/></svg>'],
          'whatsapp' => ['label' => 'WhatsApp', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5.1-1.4A10 10 0 1 0 12 2Zm0 2a8 8 0 0 1 6.9 12.1l.3.5-.8 2.2-2.3-.6-.5.2a8 8 0 1 1-3.6-14.4Zm-3.5 4.2c-.3 0-.6.1-.8.4-.2.3-.9.9-.9 2.2s.9 2.6 1 2.8c.1.2 1.8 2.8 4.4 3.8 2.1.8 2.6.7 3.1.6.5-.1 1.5-.6 1.7-1.3.2-.7.2-1.2.2-1.4-.1-.1-.4-.2-.9-.5l-1.8-.9c-.3-.1-.5-.2-.7.2-.2.4-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.5-1.5-1.8-.2-.3 0-.5.1-.6l.4-.5c.1-.1.2-.3.3-.5v-.5c0-.1-.4-1-.6-1.3-.1-.3-.3-.3-.4-.3Z"/></svg>'],
      ];
    @endphp
    <div class="topbar-social" aria-label="Social links">
      @foreach($socials as $key => $social)
        @php $url = config('loving.social.'.$key); @endphp
        @if($url)
          <a class="topbar-social-link" href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}">{!! $social['icon'] !!}</a>
        @else
          <span class="topbar-social-link is-pending" aria-label="{{ $social['label'] }} link not configured" title="{{ $social['label'] }} link not configured">{!! $social['icon'] !!}</span>
        @endif
      @endforeach
    </div>
  </div>
</div>
<header class="site-header">
  <div class="wrap nav">
    <a class="brand" href="{{ route('home') }}" aria-label="Loving Arms Home Care home">
      <svg viewBox="0 0 64 64" aria-hidden="true"><path d="M32 55S7 39 7 21C7 8 23 3 32 17 41 3 57 8 57 21c0 18-25 34-25 34Z" fill="#f0eaf6" stroke="#624684" stroke-width="2.5"/><path d="M17 29 32 17l15 12v15H17Z" fill="#fff" stroke="#3f2b5b" stroke-width="2.3" stroke-linejoin="round"/><path d="M27 44c0-7 10-7 10 0" fill="none" stroke="#6f7f63" stroke-width="3" stroke-linecap="round"/><path d="M32 31v6m-3-3h6" stroke="#8a70a6" stroke-width="2" stroke-linecap="round"/></svg>
      <span><span class="brand-name">Loving Arms</span><span class="brand-sub">HOME CARE, SPC</span></span>
    </a>
    <nav class="nav-main" id="nav-main" aria-label="Main navigation">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home</a>
      <div class="nav-drop {{ request()->routeIs('services*') ? 'active' : '' }}">
        <button type="button" aria-expanded="false">Services</button>
        <div class="nav-dropdown">
          <a href="{{ route('services') }}">All services</a>
          @foreach(config('loving.services') as $slug => $service)
            <a href="{{ route('services.show', $slug) }}">{{ $service['title'] }}</a>
          @endforeach
        </div>
      </div>
      <a href="{{ route('how-it-works') }}" class="{{ request()->routeIs('how-it-works') ? 'active' : '' }}" @if(request()->routeIs('how-it-works')) aria-current="page" @endif>How it works</a>
      <div class="nav-drop {{ request()->routeIs(['about','faq','care-standards','reviews','resources','payment']) ? 'active' : '' }}">
        <button type="button" aria-expanded="false">Learn</button>
        <div class="nav-dropdown">
          <a href="{{ route('about') }}">About us</a>
          <a href="{{ route('care-standards') }}">Our care standards</a>
          <a href="{{ route('faq') }}">FAQ</a>
          <a href="{{ route('payment') }}">Payment options</a>
          <a href="{{ route('resources') }}">Family resources</a>
          <a href="{{ route('reviews') }}">Reviews & feedback</a>
          @foreach(config('loving.areas') as $slug => $area)
            <a href="{{ route('areas.show', $slug) }}">{{ $area['name'] }}</a>
          @endforeach
        </div>
      </div>
      <a href="{{ route('staffing') }}" class="{{ request()->routeIs('staffing') ? 'active' : '' }}" @if(request()->routeIs('staffing')) aria-current="page" @endif>For facilities</a>
      <a href="{{ route('careers') }}" class="{{ request()->routeIs('careers') ? 'active' : '' }}" @if(request()->routeIs('careers')) aria-current="page" @endif>Careers</a>
      <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}" @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
    </nav>
    <div class="nav-actions">
      <a class="call-link" href="tel:{{ config('loving.phone_digits') }}"><span>☎</span>{{ config('loving.phone') }}</a>
      <a class="btn btn-primary btn-small" href="{{ route('contact') }}">Request a consultation</a>
      <button class="menu" id="menu-button" type="button" aria-label="Open menu" aria-controls="nav-main" aria-expanded="false">☰</button>
    </div>
  </div>
</header>
<main id="main">
@include('partials.flash')
@yield('content')
</main>
<footer>
  <div class="wrap">
    <div class="foot">
      <div>
        <a class="brand" href="{{ route('home') }}">
          <svg viewBox="0 0 64 64" aria-hidden="true"><path d="M32 55S7 39 7 21C7 8 23 3 32 17 41 3 57 8 57 21c0 18-25 34-25 34Z" fill="none" stroke="#b49ac7" stroke-width="2.5"/><path d="M17 29 32 17l15 12v15H17Z" fill="none" stroke="#e6dcee" stroke-width="2.3"/></svg>
          <span><span class="brand-name">Loving Arms</span><span class="brand-sub">HOME CARE, SPC</span></span>
        </a>
        <p>Care that feels like family. Person-centered support, clear communication and thoughtful next steps for families and facilities in King and Pierce Counties.</p>
        <p><a href="tel:{{ config('loving.phone_digits') }}">{{ config('loving.phone') }}</a> · <a href="mailto:{{ config('loving.email') }}">{{ config('loving.email') }}</a></p>
      </div>
      <div><h4>Care</h4><div class="foot-links"><a href="{{ route('services') }}">Services</a><a href="{{ route('how-it-works') }}">How it works</a><a href="{{ route('care-standards') }}">Care standards</a><a href="{{ route('faq') }}">FAQ</a><a href="{{ route('payment') }}">Payment options</a></div></div>
      <div><h4>Company</h4><div class="foot-links"><a href="{{ route('about') }}">About us</a><a href="{{ route('resources') }}">Family resources</a><a href="{{ route('reviews') }}">Reviews & feedback</a><a href="{{ route('careers') }}">Careers</a><a href="{{ route('staffing') }}">Facility staffing</a></div></div>
      <div><h4>Locations</h4><div class="foot-links">@foreach(config('loving.areas') as $slug => $area)<a href="{{ route('areas.show', $slug) }}">{{ $area['name'] }}</a>@endforeach</div></div>
    </div>
    <div class="copyright"><span>© {{ date('Y') }} {{ config('loving.company') }}. All rights reserved.</span><span><a href="{{ route('privacy') }}">Privacy</a> · <a href="{{ route('privacy-practices') }}">Privacy practices</a> · <a href="{{ route('terms') }}">Terms</a> · <a href="{{ route('accessibility') }}">Accessibility</a></span></div>
    <div class="copyright"><span>Information on this website is general and does not guarantee service availability, coverage, licensing status or authorization.</span><span>Our licensing application is awaiting approval.</span></div>
  </div>
</footer>
<script>
(function(){
  var nav=document.querySelector('.nav');
  var button=document.getElementById('menu-button');
  var main=document.getElementById('nav-main');
  if(button&&main){
    button.addEventListener('click',function(){
      var open=nav.classList.toggle('open');
      button.setAttribute('aria-expanded',open?'true':'false');
      button.setAttribute('aria-label',open?'Close menu':'Open menu');
      button.textContent=open?'×':'☰';
    });
    document.addEventListener('click',function(e){
      if(!nav.contains(e.target)&&nav.classList.contains('open')){
        nav.classList.remove('open');
        button.setAttribute('aria-expanded','false');
        button.setAttribute('aria-label','Open menu');
        button.textContent='☰';
      }
    });
    document.addEventListener('keydown',function(e){
      if(e.key==='Escape'&&nav.classList.contains('open')){
        nav.classList.remove('open');
        button.setAttribute('aria-expanded','false');
        button.setAttribute('aria-label','Open menu');
        button.textContent='☰';
        button.focus();
      }
    });
    main.querySelectorAll('a').forEach(function(link){
      link.addEventListener('click',function(){
        nav.classList.remove('open');
        button.setAttribute('aria-expanded','false');
        button.setAttribute('aria-label','Open menu');
        button.textContent='☰';
      });
    });
  }
  document.querySelectorAll('.nav-drop>button').forEach(function(btn){
    btn.addEventListener('click',function(){
      if(window.matchMedia('(max-width:1050px)').matches){
        var drop=btn.parentElement;
        var open=drop.classList.toggle('open');
        btn.setAttribute('aria-expanded',open?'true':'false');
      }
    });
  });
})();
</script>
@if(config('loving.analytics_enabled'))
<script>
(function(){
  var token=document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var send=function(event){
    fetch('{{ route('analytics.store') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':token,'Accept':'application/json'},body:JSON.stringify({event:event,path:window.location.pathname}),keepalive:true}).catch(function(){});
  };
  send('page_view');
  document.querySelectorAll('form[data-analytics]').forEach(function(form){
    form.addEventListener('submit',function(){send(form.getAttribute('data-analytics'));},{once:true});
  });
})();
</script>
@endif
@stack('scripts')
</body>
</html>
