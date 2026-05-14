<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, maximum-scale=1, user-scalable=no" />
  <!-- Preload del .mind file: empieza a descargarse en cuanto el navegador lee este HTML -->
  <link rel="preload" href="{{ asset('aframe/examples/assets/murales/muralesFF3.mind') }}" as="fetch" crossorigin="anonymous">
  <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
    }

    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
      background: #000;
    }

    body {
      position: fixed;
      inset: 0;
    }

    /* ── AR Scene & Camera Feed ─────────────────────────── */
    a-scene {
      position: fixed !important;
      inset: 0 !important;
      width: 100vw !important;
      height: 100vh !important;
      z-index: 1 !important;
      background: transparent !important;
    }

    video:not(.modal-video),
    canvas {
      position: fixed !important;
      inset: 0 !important;
      width: 100vw !important;
      height: 100vh !important;
      object-fit: cover !important;
      z-index: 1 !important;
    }

    /* ── Top overlay button ─────────────────────────────── */
    #overlay {
      position: fixed;
      top: max(14px, env(safe-area-inset-top, 14px));
      left: max(14px, env(safe-area-inset-left, 14px));
      z-index: 9999;
    }

    .back-btn {
      width: 48px;
      height: 48px;
      border: none;
      border-radius: 14px;
      background: linear-gradient(145deg, #94134A, #6e0e37);
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 14px rgba(148, 19, 74, 0.45);
      transition: transform .15s, box-shadow .15s;
    }

    .back-btn:active {
      transform: scale(.93);
      box-shadow: 0 2px 8px rgba(148, 19, 74, 0.35);
    }

    /* ── Modal backdrop ─────────────────────────────────── */
    #customModal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
      z-index: 99999;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      padding: 0;
      padding-bottom: 0;
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
    }

    #customModal.hidden {
      display: none !important;
    }

    /* ── Modal card (bottom sheet style) ───────────────── */
    .modal-container {
      width: 100%;
      max-width: 520px;
      background: #fff;
      border-radius: 24px 24px 0 0;
      padding: 0 0 max(20px, env(safe-area-inset-bottom, 20px));
      animation: slideUp .3s cubic-bezier(.25,.8,.25,1);
      height: 85dvh;
      height: 85vh;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      display: flex;
      flex-direction: column;
    }

    @keyframes slideUp {
      from { transform: translateY(100%); opacity: 0; }
      to   { transform: translateY(0);   opacity: 1; }
    }

    /* Drag handle */
    .modal-handle {
      width: 40px;
      height: 5px;
      background: #ddd;
      border-radius: 3px;
      margin: 14px auto 12px;
    }

    /* ── Video section ──────────────────────────────────── */
    .modal-video-wrap {
      width: 100%;
      background: #000;
      position: relative;
      flex: 1;
      display: flex;
      align-items: center;
      min-height: 0;
    }

    .modal-video {
      width: 100%;
      height: 100%;
      display: block;
      object-fit: contain;
      background: #000;
    }

    /* Larger on tablets / wider screens */
    @media (min-width: 480px) {
      .modal-video {
        max-height: 300px;
      }
    }

    @media (min-width: 640px) {
      .modal-video {
        max-height: 360px;
      }
    }

    /* ── Route section ──────────────────────────────────── */
    .route-section {
      padding: 14px 16px 4px;
    }

    .route-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: #94134A;
      margin-bottom: 10px;
    }

    .gif-wrapper {
      width: 100%;
      background: #f7f7f7;
      border: 1px solid #ececec;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 8px;
      min-height: 80px;
    }

    .direction-gif {
      max-width: 100%;
      width: auto;
      height: auto;
      max-height: 120px;
      object-fit: contain;
      display: block;
    }

    @media (min-width: 480px) {
      .direction-gif {
        max-height: 160px;
      }
    }

    /* ── Actions ────────────────────────────────────────── */
    .modal-actions {
      padding: 12px 16px 0;
      display: flex;
      gap: 10px;
    }

    .close-btn {
      flex: 1;
      padding: 14px;
      background: linear-gradient(145deg, #94134A, #6e0e37);
      color: #fff;
      border: none;
      border-radius: 14px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      letter-spacing: .02em;
      transition: transform .15s, box-shadow .15s;
      box-shadow: 0 4px 14px rgba(148, 19, 74, 0.35);
    }

    .close-btn:active {
      transform: scale(.97);
      box-shadow: 0 2px 8px rgba(148, 19, 74, 0.25);
    }

    /* ── Dark-mode awareness ────────────────────────────── */
    @media (prefers-color-scheme: dark) {
      .modal-container { background: #1c1c1e; }
      .modal-handle { background: #444; }
      .gif-wrapper { background: #2c2c2e; border-color: #3a3a3c; }
      .route-label { color: #e05080; }
    }

    /* ── Landscape phone ────────────────────────────────── */
    @media (orientation: landscape) and (max-height: 500px) {
      #customModal {
        align-items: center;
        padding: 0 16px;
      }

      .modal-container {
        border-radius: 20px;
        height: 94dvh;
        height: 94vh;
        max-width: 600px;
      }
    }

    /* ── Loading overlay ─────────────────────────────────── */
    #loading-overlay {
      position: fixed;
      inset: 0;
      background: #0a0a0a;
      z-index: 999999;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 22px;
      transition: opacity .5s ease;
    }
    #loading-overlay.fade-out {
      opacity: 0;
      pointer-events: none;
    }
    .loading-logo { height: 52px; width: auto; opacity: .85; }
    .loading-spinner {
      width: 44px;
      height: 44px;
      border: 4px solid rgba(255,255,255,.15);
      border-top-color: #94134A;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .loading-text { color: rgba(255,255,255,.55); font-size: .82rem; letter-spacing: .04em; }
  </style>
</head>

<body>

  <!-- Loading screen -->
  <div id="loading-overlay">
    <img class="loading-logo" src="{{ asset('images/congreso.png') }}" alt="Congreso">
    <div class="loading-spinner"></div>
    <p class="loading-text">Iniciando cámara…</p>
  </div>

  <div id="overlay">
    <button id="menuBtn" class="back-btn" type="button" aria-label="Regresar">
      <i class="fa-solid fa-arrow-left"></i>
    </button>
  </div>

  <!-- ── A-Frame Scene ───────────────────────────────────── -->
  <a-scene
    mindar-image="imageTargetSrc: {{ asset('aframe/examples/assets/murales/muralesFF3.mind') }}; filterMinCF:0.0001; filterBeta:0.0001;"
    color-space="sRGB"
    renderer="colorManagement: true, physicallyCorrectLights"
    vr-mode-ui="enabled: false"
    device-orientation-permission-ui="enabled: false"
    embedded
  >
    <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>
    <a-entity light="type: directional; intensity: 1" position="1 1 1"></a-entity>
    <a-entity light="type: ambient; intensity: 0.5"></a-entity>

    <a-entity mindar-image-target="targetIndex: 0"></a-entity>
    <a-entity mindar-image-target="targetIndex: 1"></a-entity>
    <a-entity mindar-image-target="targetIndex: 2"></a-entity>
    <a-entity mindar-image-target="targetIndex: 3"></a-entity>
    <a-entity mindar-image-target="targetIndex: 4"></a-entity>
    <a-entity mindar-image-target="targetIndex: 5"></a-entity>
    <a-entity mindar-image-target="targetIndex: 6"></a-entity>
    <a-entity mindar-image-target="targetIndex: 7"></a-entity>
    <a-entity mindar-image-target="targetIndex: 8"></a-entity>
    <a-entity mindar-image-target="targetIndex: 9"></a-entity>
    <a-entity mindar-image-target="targetIndex: 10"></a-entity>
    <a-entity mindar-image-target="targetIndex: 11"></a-entity>
    <a-entity mindar-image-target="targetIndex: 12"></a-entity>
    <a-entity mindar-image-target="targetIndex: 13"></a-entity>
    <a-entity mindar-image-target="targetIndex: 14"></a-entity>
    <a-entity mindar-image-target="targetIndex: 15"></a-entity>
    <a-entity mindar-image-target="targetIndex: 16"></a-entity>
    <a-entity mindar-image-target="targetIndex: 17"></a-entity>
    <a-entity mindar-image-target="targetIndex: 18"></a-entity>
    <a-entity mindar-image-target="targetIndex: 19"></a-entity>
    <a-entity mindar-image-target="targetIndex: 20"></a-entity>
    <a-entity mindar-image-target="targetIndex: 21"></a-entity>
    <a-entity mindar-image-target="targetIndex: 22"></a-entity>
    <a-entity mindar-image-target="targetIndex: 23"></a-entity>
    <a-entity mindar-image-target="targetIndex: 24"></a-entity>
    <a-entity mindar-image-target="targetIndex: 25"></a-entity>
    <a-entity mindar-image-target="targetIndex: 26"></a-entity>
    <a-entity mindar-image-target="targetIndex: 27"></a-entity>
    <a-entity mindar-image-target="targetIndex: 28"></a-entity>
    <a-entity mindar-image-target="targetIndex: 29"></a-entity>
    <a-entity mindar-image-target="targetIndex: 30"></a-entity>
    <a-entity mindar-image-target="targetIndex: 31"></a-entity>
  </a-scene>

  <!-- ── Modal ────────────────────────────────────────────── -->
  <div id="customModal" class="hidden" role="dialog" aria-modal="true" aria-label="Información del mural">
    <div class="modal-container">
      <div class="modal-handle"></div>

      <div class="modal-video-wrap" id="videoWrap"></div>

      <div class="route-section">
        <div class="route-label">¿Hacia dónde ir?</div>
        <div class="gif-wrapper">
          <img
            id="directionGif"
            class="direction-gif"
            src="{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}"
            alt="Diagrama de ruta al mural"
          >
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="close-btn" onclick="closeModal()">Cerrar</button>
      </div>
    </div>
  </div>

  <!-- ── Scripts ──────────────────────────────────────────── -->
  <script>
    const targetVideos = {
      0: "{{ asset('aframe/examples/assets/murales/01EmbrionPlastico.mp4') }}",
      1: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      2: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      3: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      4: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      5: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      6: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      7: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      8: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      9: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      10: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      11: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      12: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      13: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      14: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      15: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      16: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      17: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      18: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      19: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      20: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      21: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      22: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      23: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      24: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      25: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      26: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      27: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      28: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      29: "{{ asset('aframe/examples/assets/murales/07MuroSurpuertaOriente.mp4') }}",
      30: "{{ asset('aframe/examples/assets/murales/08MuroNortepuertaOriente.mp4') }}",
      31: "{{ asset('aframe/examples/assets/murales/09Vestibuloladonorte.mp4') }}"
    };

    const targetDirections = {
      0:  "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      1:  "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      2:  "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      3:  "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      4:  "{{ asset('aframe/examples/assets/murales/gifs/3.gif') }}",
      5:  "{{ asset('aframe/examples/assets/murales/gifs/3.gif') }}",
      6:  "{{ asset('aframe/examples/assets/murales/gifs/3.gif') }}",
      7:  "{{ asset('aframe/examples/assets/murales/gifs/3.gif') }}",
      8:  "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      9:  "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      10: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      11: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      12: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      13: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      14: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      15: "{{ asset('aframe/examples/assets/murales/gifs/8-9.gif') }}",
      16: "{{ asset('aframe/examples/assets/murales/gifs/8-9.gif') }}",
      17: "{{ asset('aframe/examples/assets/murales/gifs/8-9.gif') }}",
      18: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
      19: "{{ asset('aframe/examples/assets/murales/gifs/8-9.gif') }}",
      20: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      21: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      22: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      23: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      24: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      25: "{{ asset('aframe/examples/assets/murales/gifs/12-13.gif') }}",
      26: "{{ asset('aframe/examples/assets/murales/gifs/12-13.gif') }}",
      27: "{{ asset('aframe/examples/assets/murales/gifs/12-13.gif') }}",
      28: "{{ asset('aframe/examples/assets/murales/gifs/12-13.gif') }}",
      29: "{{ asset('aframe/examples/assets/murales/gifs/11-12.gif') }}",
      30: "{{ asset('aframe/examples/assets/murales/gifs/11-12.gif') }}",
      31: "{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}"
    };

    document.addEventListener("DOMContentLoaded", () => {
      const modal    = document.getElementById("customModal");
      const videoWrap = document.getElementById("videoWrap");
      const dirGif   = document.getElementById("directionGif");
      const menuBtn  = document.getElementById("menuBtn");
      const loadingOverlay = document.getElementById("loading-overlay");

      let currentIdx = null;
      let modalOpen  = false;
      let cooldown   = false;

      /* ── Pre-buffer one <video> per unique src ── */
      const videoCache = {};
      const uniqueSrcs = [...new Set(Object.values(targetVideos))];

      uniqueSrcs.forEach(src => {
        const v = document.createElement("video");
        v.className = "modal-video";
        v.preload   = "auto";
        v.controls  = true;
        v.setAttribute("playsinline", "");
        v.setAttribute("webkit-playsinline", "");
        v.setAttribute("x5-playsinline", "");
        v.src = src;
        v.style.display    = "none";
        videoWrap.appendChild(v);
        videoCache[src] = v;
      });

      /* ── Hide loading overlay when MindAR is ready ── */
      const scene = document.querySelector("a-scene");
      const hideLoading = () => {
        loadingOverlay.classList.add("fade-out");
        setTimeout(() => loadingOverlay.remove(), 500);
      };
      scene.addEventListener("arReady", hideLoading);
      /* Fallback: si arReady no dispara en 15 s, quitamos el overlay igual */
      setTimeout(hideLoading, 15000);

      /* ── Listen for AR target events ── */
      document.querySelectorAll("[mindar-image-target]").forEach((el) => {
        const attr  = el.getAttribute("mindar-image-target");
        const match = attr && attr.match(/targetIndex:\s*(\d+)/);
        if (!match) return;

        const idx = Number(match[1]);
        el.addEventListener("targetFound", () => {
          if (cooldown) return;
          openModal(idx);
        });
      });

      function openModal(idx) {
        if (modalOpen && currentIdx === idx) return;

        currentIdx = idx;
        modalOpen  = true;
        cooldown   = true;

        const videoSrc = targetVideos[idx];
        const gifSrc   = targetDirections[idx] || targetDirections[0];

        /* Ocultar todos los videos pre-cargados */
        Object.values(videoCache).forEach(v => {
          v.pause();
          v.style.display = "none";
        });

        dirGif.src = gifSrc;
        modal.classList.remove("hidden");

        const v = videoCache[videoSrc];
        if (v) {
          v.style.display = "block";
          v.currentTime   = 0;
          v.muted         = false;
          const p = v.play();
          if (p !== undefined) {
            p.catch(() => {
              v.muted = true;
              v.play().catch(() => {});
            });
          }
        }

        setTimeout(() => { cooldown = false; }, 1200);
      }

      window.closeModal = function () {
        modal.classList.add("hidden");
        Object.values(videoCache).forEach(v => {
          v.pause();
          v.style.display = "none";
        });
        currentIdx = null;
        modalOpen  = false;
      };

      /* Close when tapping the backdrop */
      modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
      });

      /* Back button */
      menuBtn.addEventListener("click", () => {
        window.location.href = "/";
      });
    });
  </script>
</body>
</html>
