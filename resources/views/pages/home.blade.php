@extends('layouts.site')
@section('title', 'Loving Arms Home Care, SPC | Care That Feels Like Family')
@section('description', 'Person-centered home care information and CNA staffing inquiries for families in King and Pierce Counties, Washington. Licensing application pending.')
@section('content')
<section class="hero hero-video" id="home">
  <video class="hero-video-media" autoplay muted loop playsinline preload="metadata" poster="{{ asset('hero/loving-arms-hero-poster.jpg') }}" aria-hidden="true" tabindex="-1">
    <source src="{{ asset('hero/loving-arms-hero-mobile-small.mp4') }}" type="video/mp4" media="(max-width: 768px)">
    <source src="{{ asset('hero/loving-arms-hero-small.mp4') }}" type="video/mp4">
  </video>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="wrap hero-video-in">
    <div class="hero-video-copy">
      <div class="hero-location">Serving {{ config('loving.service_area') }}</div>
      <div class="hero-slider" data-hero-slider aria-roledescription="carousel" aria-label="Home care highlights">
        <div class="hero-slides">
          <div class="hero-slide is-active" data-hero-slide aria-hidden="false">
            <div class="hero-slide-kicker">Person-centered home care</div>
            <h1>Care that feels like <em>family.</em></h1>
            <p>Respectful support at home.</p>
          </div>
          <div class="hero-slide" data-hero-slide aria-hidden="true">
            <div class="hero-slide-kicker">Everyday support</div>
            <h1>Help with the <em>little things.</em></h1>
            <p>Personal care, companionship and daily living support.</p>
          </div>
          <div class="hero-slide" data-hero-slide aria-hidden="true">
            <div class="hero-slide-kicker">Clear next steps</div>
            <h1>We listen <em>first.</em></h1>
            <p>Then we explain what comes next.</p>
          </div>
        </div>
        <div class="hero-slider-controls">
          <div class="hero-dots" role="group" aria-label="Choose a highlight">
            <button type="button" class="hero-dot is-active" data-hero-dot="0" aria-label="Show highlight 1" aria-current="true"></button>
            <button type="button" class="hero-dot" data-hero-dot="1" aria-label="Show highlight 2"></button>
            <button type="button" class="hero-dot" data-hero-dot="2" aria-label="Show highlight 3"></button>
          </div>
          <button type="button" class="hero-pause" data-hero-pause aria-label="Pause highlight and video" aria-pressed="false">Pause</button>
        </div>
      </div>
      <div class="actions hero-actions">
        <a class="btn btn-primary" href="{{ route('contact') }}">Request a consultation</a>
        <a class="btn btn-outline-light" href="{{ route('services') }}">Explore services</a>
      </div>
      <div class="hero-footnote">Licensing application awaiting approval · Emergencies: call 911</div>
    </div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  var root=document.querySelector('[data-hero-slider]');
  if(!root)return;
  var slides=Array.prototype.slice.call(root.querySelectorAll('[data-hero-slide]'));
  var dots=Array.prototype.slice.call(root.querySelectorAll('[data-hero-dot]'));
  var pause=root.querySelector('[data-hero-pause]');
  var reduced=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var video=document.querySelector('.hero-video-media');
  var index=0;
  var timer=null;
  if(reduced&&video){video.pause();video.removeAttribute('autoplay');}
  function show(next){
    index=(next+slides.length)%slides.length;
    slides.forEach(function(slide,i){
      var active=i===index;
      slide.classList.toggle('is-active',active);
      slide.setAttribute('aria-hidden',active?'false':'true');
    });
    dots.forEach(function(dot,i){
      var active=i===index;
      dot.classList.toggle('is-active',active);
      if(active){dot.setAttribute('aria-current','true');}else{dot.removeAttribute('aria-current');}
    });
  }
  function start(){
    if(reduced||timer||slides.length<2)return;
    timer=window.setInterval(function(){show(index+1);},6000);
  }
  function stop(){
    if(timer){window.clearInterval(timer);timer=null;}
  }
  dots.forEach(function(dot,i){
    dot.addEventListener('click',function(){stop();show(i);start();});
  });
  if(pause){
    if(reduced){pause.hidden=true;}
    else{
      pause.addEventListener('click',function(){
        if(timer){stop();if(video)video.pause();pause.textContent='Play';pause.setAttribute('aria-label','Play highlight and video');pause.setAttribute('aria-pressed','true');}
        else{start();if(video&&!reduced){var played=video.play();if(played&&played.catch)played.catch(function(){});}pause.textContent='Pause';pause.setAttribute('aria-label','Pause highlight and video');pause.setAttribute('aria-pressed','false');}
      });
      start();
    }
  }
  document.addEventListener('visibilitychange',function(){
    if(document.hidden){stop();if(video)video.pause();}
    else if(pause&&pause.textContent==='Pause'){start();if(video&&!reduced){var played=video.play();if(played&&played.catch)played.catch(function(){});}}
  });
})();
</script>
<script>
(function(){
  var reduced=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var reveals=Array.prototype.slice.call(document.querySelectorAll('[data-reveal]'));
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('is-visible');observer.unobserve(entry.target);}
      });
    },{threshold:.14,rootMargin:'0px 0px -40px 0px'});
    reveals.forEach(function(el){observer.observe(el);});
  }else{
    reveals.forEach(function(el){el.classList.add('is-visible');});
  }
  var section=document.querySelector('[data-parallax]');
  var bg=section?section.querySelector('[data-parallax-bg]'):null;
  if(section&&bg&&!reduced){
    var ticking=false;
    function update(){
      var rect=section.getBoundingClientRect();
      var progress=(rect.top+rect.height/2-window.innerHeight/2)/window.innerHeight;
      var shift=Math.max(-90,Math.min(90,progress*-80));
      bg.style.setProperty('--parallax-y',shift.toFixed(1)+'px');
      ticking=false;
    }
    function onScroll(){
      if(ticking)return;
      ticking=true;
      window.requestAnimationFrame(update);
    }
    window.addEventListener('scroll',onScroll,{passive:true});
    window.addEventListener('resize',onScroll);
    update();
  }
  var tilts=Array.prototype.slice.call(document.querySelectorAll('[data-tilt]'));
  tilts.forEach(function(el){
    function reset(){
      el.style.setProperty('--mx','50%');
      el.style.setProperty('--my','50%');
      el.style.setProperty('--rx','0deg');
      el.style.setProperty('--ry','0deg');
    }
    reset();
    el.addEventListener('pointermove',function(e){
      if(reduced||e.pointerType==='touch')return;
      var rect=el.getBoundingClientRect();
      var x=(e.clientX-rect.left)/rect.width;
      var y=(e.clientY-rect.top)/rect.height;
      el.style.setProperty('--mx',(x*100).toFixed(1)+'%');
      el.style.setProperty('--my',(y*100).toFixed(1)+'%');
      el.style.setProperty('--rx',((.5-y)*5).toFixed(2)+'deg');
      el.style.setProperty('--ry',((x-.5)*5).toFixed(2)+'deg');
    });
    el.addEventListener('pointerleave',reset);
  });
})();
</script>
@endpush

<div class="trust-strip">
  <div class="trust-item" data-reveal data-tilt><strong>Listen first</strong><span>Routines, preferences and goals</span></div>
  <div class="trust-item" data-reveal data-tilt><strong>Plan together</strong><span>Families included in decisions</span></div>
  <div class="trust-item" data-reveal data-tilt><strong>Clear updates</strong><span>Agreed contacts and communication</span></div>
  <div class="trust-item" data-reveal data-tilt><strong>Licensing pending</strong><span>Application submitted, awaiting approval</span></div>
</div>

<section id="services">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <div class="eyebrow">How we can help</div>
      <h2>Support for everyday living</h2>
      <p>Explore non-medical home care topics. What can be provided depends on assessment, staffing, applicable approvals and the agreed plan.</p>
    </div>
    <div class="cards">
      @foreach($services as $slug => $service)
        <a class="card service-card" href="{{ route('services.show', $slug) }}" data-reveal data-tilt>
          <div class="card-icon" aria-hidden="true">{{ $service['icon'] }}</div>
          <h3>{{ $service['title'] }}</h3>
          <p>{{ $service['short'] }}</p>
          <span class="card-link">Explore {{ $service['title'] }} →</span>
        </a>
      @endforeach
    </div>
    <div class="actions" data-reveal>
      <a class="btn btn-outline" href="{{ route('services') }}">View all services</a>
    </div>
  </div>
</section>

<section class="cream" id="how-care-starts">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <div class="eyebrow">A clear first step</div>
      <h2>How care starts</h2>
      <p>No pressure and no assumptions. We begin by listening, then explain what still needs to be confirmed.</p>
    </div>
    <div class="process">
      <div class="process-item" data-reveal data-tilt><div class="process-num">01</div><h3>Tell us what matters</h3><p>Share routines, preferences and the support you have in mind by phone, email or the inquiry form.</p></div>
      <div class="process-item" data-reveal data-tilt><div class="process-num">02</div><h3>Review the details</h3><p>We discuss needs, location, service requirements and which approvals or authorizations apply.</p></div>
      <div class="process-item" data-reveal data-tilt><div class="process-num">03</div><h3>Agree on a plan</h3><p>Schedule, caregiver match and service terms are reviewed with the client or authorized representative.</p></div>
      <div class="process-item" data-reveal data-tilt><div class="process-num">04</div><h3>Review and adjust</h3><p>Once a service begins, agreed communication and regular reviews keep the plan aligned with changing needs.</p></div>
    </div>
    <div class="notice page-notice" data-reveal>A conversation does not guarantee availability, coverage or authorization. Our licensing application is awaiting approval, and services begin only when all required approvals are in place.</div>
  </div>
</section>

<section class="parallax-section" data-parallax aria-label="Care in the place they know">
  <div class="parallax-bg" data-parallax-bg style="background-image:url('{{ asset('images/caregiving-hands.jpg') }}')" aria-hidden="true"></div>
  <div class="parallax-shade" aria-hidden="true"></div>
  <div class="wrap parallax-in">
    <div class="parallax-card" data-reveal>
      <div class="eyebrow eyebrow-light">Care in the place they know</div>
      <h2>A steady hand.<br><em>A familiar home.</em></h2>
      <p>Support should fit the person, the routine and the home — not the other way around.</p>
      <div class="parallax-actions">
        <a class="btn btn-light" href="{{ route('contact') }}">Start a conversation</a>
        <a class="parallax-link" href="{{ route('services') }}">See how we help →</a>
      </div>
    </div>
    <div class="parallax-notes" data-reveal>
      <span>Dignity</span><span>Patience</span><span>Family included</span>
    </div>
  </div>
  <div class="photo-credit">Photo by <a href="https://unsplash.com/photos/an-older-woman-holding-a-babys-hand-y0OAmd_COUM" target="_blank" rel="noopener noreferrer">Rod Long</a> on <a href="https://unsplash.com" target="_blank" rel="noopener noreferrer">Unsplash</a></div>
</section>

<section class="soft" id="standards">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <div class="eyebrow">What guides us</div>
      <h2>Care standards you can ask about</h2>
      <p>Practical commitments that shape every conversation about support at home.</p>
    </div>
    <div class="cards">
      @foreach(array_slice(config('loving.standards'), 0, 3) as $standard)
        <article class="card" data-reveal data-tilt>
          <div class="card-icon" aria-hidden="true">{{ $standard['icon'] }}</div>
          <h3>{{ $standard['title'] }}</h3>
          <p>{{ $standard['text'] }}</p>
        </article>
      @endforeach
    </div>
    <div class="actions" data-reveal>
      <a class="btn btn-outline" href="{{ route('care-standards') }}">See our care standards</a>
    </div>
  </div>
</section>

<section id="faq-preview">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <div class="eyebrow">Common questions</div>
      <h2>Good questions deserve clear answers</h2>
      <p>A few of the topics families ask about most often.</p>
    </div>
    <div class="faq-list">
      @foreach($faqs as $faq)
        <details class="faq-item" data-reveal>
          <summary>{{ $faq['question'] }}</summary>
          <p>{{ $faq['answer'] }}</p>
        </details>
      @endforeach
    </div>
    <div class="actions" data-reveal>
      <a class="btn btn-outline" href="{{ route('faq') }}">Read all FAQs</a>
    </div>
  </div>
</section>

<section class="section-tight" id="areas">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <div class="eyebrow">Local focus</div>
      <h2>Find information for your area</h2>
      <p>We focus on {{ config('loving.service_area') }}. Send your city or ZIP code and we will confirm what we can discuss.</p>
    </div>
    <div class="cards four">
      @foreach($areas as $slug => $area)
        <a class="card" href="{{ route('areas.show', $slug) }}" data-reveal data-tilt>
          <h3>{{ $area['name'] }}</h3>
          <p>{{ $area['county'] }} · {{ $area['nearby'] }}</p>
          <span class="card-link">View local information →</span>
        </a>
      @endforeach
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="band" data-reveal data-tilt>
      <div>
        <div class="eyebrow">For healthcare facilities</div>
        <h2>CNA and caregiver staffing inquiries</h2>
        <p>Facility administrators and staffing coordinators can discuss coverage needs, shift requirements and potential arrangements. Credentials, scope, orientation, supervision and contract terms are confirmed before any assignment.</p>
      </div>
      <a class="btn btn-light" href="{{ route('staffing') }}">Discuss facility staffing</a>
    </div>
  </div>
</section>
@endsection
