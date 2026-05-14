<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Murales · Poder Legislativo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Precarga silenciosa de recursos AR mientras el usuario lee esta pantalla -->
  <link rel="prefetch" href="https://aframe.io/releases/1.5.0/aframe.min.js" as="script">
  <link rel="prefetch" href="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js" as="script">
  <link rel="prefetch" href="{{ asset('aframe/examples/assets/murales/muralesFF3.mind') }}" as="fetch" crossorigin="anonymous">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --brand:     #94134A;
      --brand-dk:  #6e0e37;
      --gold:      #ae8449;
      --gold-lt:   #c9a06a;
      --page-bg:   #f8f4f6;
      --card-bg:   #ffffff;
      --text:      #1a1a1a;
      --muted:     #6b6b6b;
      --radius:    18px;
    }

    html, body {
      height: 100%;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
      background: var(--page-bg);
      color: var(--text);
    }

    /* ── Layout ─────────────────────────────────────────── */
    .page {
      min-height: 100dvh;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ── Header bar ─────────────────────────────────────── */
    .header {
      background: var(--card-bg);
      border-bottom: 1px solid rgba(148,19,74,.10);
      padding: 14px 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .header img {
      height: 40px;
      width: auto;
      object-fit: contain;
    }

    /* ── Hero ────────────────────────────────────────────── */
    .hero {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 32px 20px 40px;
      gap: 24px;
    }

    /* Camera icon badge */
    .icon-badge {
      width: 80px;
      height: 80px;
      border-radius: 22px;
      background: var(--brand);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(148,19,74,.30);
    }

    .icon-badge i {
      font-size: 34px;
      color: #fff;
    }

    /* Text block */
    .hero-text {
      text-align: center;
      max-width: 340px;
    }

    .hero-text h1 {
      font-size: clamp(1.55rem, 5vw, 2rem);
      font-weight: 800;
      line-height: 1.15;
      color: var(--brand);
      margin-bottom: 12px;
      letter-spacing: -.01em;
    }

    .hero-text p {
      font-size: clamp(.9rem, 3.5vw, 1rem);
      line-height: 1.55;
      color: var(--muted);
    }

    /* Instruction steps */
    .steps {
      width: 100%;
      max-width: 360px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .step {
      background: var(--card-bg);
      border: 1px solid rgba(148,19,74,.12);
      border-radius: 14px;
      padding: 14px 16px;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .step-num {
      width: 32px;
      height: 32px;
      min-width: 32px;
      border-radius: 50%;
      background: var(--brand);
      color: #fff;
      font-size: 14px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .step p {
      font-size: .9rem;
      line-height: 1.4;
      color: var(--text);
    }

    .step p strong {
      color: var(--brand);
      font-weight: 700;
    }

    /* CTA button */
    .btn-wrap {
      width: 100%;
      max-width: 360px;
    }

    .btn-start {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
      padding: 17px 24px;
      background: var(--brand);
      color: #fff;
      text-decoration: none;
      font-size: 1.05rem;
      font-weight: 700;
      border-radius: var(--radius);
      letter-spacing: .02em;
      transition: background .2s, transform .15s, box-shadow .15s;
      box-shadow: 0 6px 20px rgba(148,19,74,.35);
    }

    .btn-start:hover  { background: var(--brand-dk); box-shadow: 0 8px 24px rgba(148,19,74,.45); }
    .btn-start:active { transform: scale(.97); box-shadow: 0 3px 10px rgba(148,19,74,.30); }

    .btn-start i { font-size: 18px; }

    /* ── Footer ──────────────────────────────────────────── */
    footer {
      background: var(--gold);
      padding: 16px 20px max(16px, env(safe-area-inset-bottom, 16px));
      text-align: center;
    }

    .footer-links {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 6px 10px;
      font-size: .85rem;
      color: #fff;
    }

    .footer-links a {
      color: #fff;
      text-decoration: none;
      opacity: .9;
    }

    .footer-links a:hover { opacity: 1; text-decoration: underline; }
    .footer-links .sep { opacity: .5; }

    /* ── Responsive tweaks ───────────────────────────────── */
    @media (max-width: 400px) {
      .hero { padding: 24px 16px 32px; gap: 20px; }
      .icon-badge { width: 68px; height: 68px; border-radius: 18px; }
      .icon-badge i { font-size: 28px; }
    }

    @media (min-height: 800px) {
      .hero { gap: 30px; padding-top: 48px; }
    }
  </style>
</head>
<body>

<div class="page">

  <!-- Header -->
  <header class="header">
    <img src="{{ asset('images/congreso.png') }}" alt="Congreso del Estado de México">
  </header>

  <!-- Hero -->
  <main class="hero">

    <!-- Después del <header> y antes de .hero > .icon-badge -->

    <!-- Logo de Leopoldo Flores -->
    <div style="display:flex; justify-content:center; margin-bottom: 3px;">
      <img src="{{ asset('aframe/examples/assets/murales/tituloMurales.png') }}" alt="Leopoldo Flores" style="height:98px; width:auto; object-fit:contain;">
    </div>

    <!-- Texto introductorio -->
    <div style="max-width:380px; margin-bottom:28px; text-align:justify;">
      <p style="font-size:.875rem; line-height:1.65; color:#4a4a4a;">
        El hombre contemplando al hombre reúne una selección emblemática de la obra de Leopoldo Flores, creador fundamental del arte mexicano contemporáneo y figura imprescindible en la vida cultural del Estado de México. Su producción artística, profundamente humanista, interpela al espectador desde una mirada crítica y reflexiva sobre el ser humano, su tiempo y su entorno.
      </p>
      <p style="font-size:.875rem; line-height:1.65; color:#4a4a4a; margin-top:10px;">
        Más allá de lo formal, la obra de Flores se erige como testimonio de una defensa constante del arte público, de la cultura como derecho y de los espacios de creación como pilares del desarrollo social. En cada trazo, el artista convoca a una contemplación consciente: el hombre frente a sí mismo, frente a su historia y frente a la responsabilidad de construir comunidad, memoria y futuro.
      </p>
    </div>

    <div class="icon-badge">
      <i class="fa-solid fa-camera"></i>
    </div>

    <div class="hero-text">
      <h1>Explora los murales</h1>
      <p>Apunta tu cámara hacia cualquier sección del mural y descubre su historia en video.</p>
    </div>

    <div class="steps">
      <div class="step">
        <div class="step-num">1</div>
        <p>Toca <strong>Comenzar</strong> y permite el acceso a tu cámara.</p>
      </div>
      <div class="step">
        <div class="step-num">2</div>
        <p>Dirígela hacia <strong>rostros o siluetas</strong> del mural.</p>
      </div>
      <div class="step">
        <div class="step-num">3</div>
        <p>Mira el <strong>video</strong> y sigue la ruta indicada.</p>
      </div>
    </div>

    <div class="btn-wrap">
      <a href="{{ route('ar.video', 1) }}" class="btn-start">
        <i class="fa-solid fa-play"></i>
        Comenzar
      </a>
    </div>

  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-links">
      <a href="https://congresoedomex.gob.mx/" target="_blank" rel="noopener">Poder Legislativo</a>
      <span class="sep">|</span>
      <a href="https://congresoedomex.gob.mx/" target="_blank" rel="noopener">congresoedomex.gob.mx</a>
    </div>
  </footer>

</div>


<!-- Contador de visitas flotante -->
<div id="visit-counter" style="
  position: fixed;
  bottom: 18px;
  right: 18px;
  background: var(--brand);
  color: #fff;
  border-radius: 50px;
  padding: 8px 14px;
  display: flex;
  align-items: center;
  gap: 7px;
  font-size: .8rem;
  font-weight: 600;
  box-shadow: 0 4px 14px rgba(148,19,74,.35);
  z-index: 9999;
  opacity: 0;
  transition: opacity .4s ease;
  user-select: none;
">
  <span style="
    display:flex; align-items:center; justify-content:center;
    background:rgba(255,255,255,.22);
    border-radius:50%;
    width:26px; height:26px;
    flex-shrink:0;
  ">
    <i class="fa-solid fa-eye" style="font-size:.9rem;"></i>
  </span>
  <span id="visit-count">…</span> visitas
</div>

<script>
(function () {
  fetch('{{ route('visitas.registrar') }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ ruta: '/' })
  })
  .then(r => r.json())
  .then(data => {
    document.getElementById('visit-count').textContent = data.contador.toLocaleString();
    document.getElementById('visit-counter').style.opacity = '1';
  })
  .catch(() => {
    document.getElementById('visit-counter').style.display = 'none';
  });
})();
</script>

</body>
</html>
