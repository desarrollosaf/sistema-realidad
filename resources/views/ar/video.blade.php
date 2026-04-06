<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, maximum-scale=1, user-scalable=no" />
  <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
    }

    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      font-family: Arial, Helvetica, sans-serif;
      background: #000;
    }

    body {
      position: fixed;
      inset: 0;
    }

    a-scene {
      position: fixed !important;
      inset: 0 !important;
      width: 100vw !important;
      height: 100vh !important;
      z-index: 1 !important;
      background: transparent !important;
    }

    /* Esto ayuda a que en móvil la cámara no se vea negra */
    video:not(.modal-video),
    canvas {
      position: fixed !important;
      inset: 0 !important;
      width: 100vw !important;
      height: 100vh !important;
      object-fit: cover !important;
      z-index: 1 !important;
      background: transparent !important;
    }

    #overlay {
      position: fixed;
      top: 12px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 9999;
      pointer-events: none;
    }

    #overlay button {
      pointer-events: auto;
    }

    .button {
      width: 48px;
      height: 48px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg, #94134A, #7a103d);
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #customModal {
      position: fixed;
      inset: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.78);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 12px;
    }

    #customModal.hidden {
      display: none !important;
    }

    .modal-container {
      width: 100%;
      max-width: 340px;
      background: #fff;
      border-radius: 18px;
      padding: 12px 12px 14px;
      text-align: center;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
      animation: fadeUp .25s ease;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(16px) scale(.98);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .modal-subtitle {
      margin: 0 0 8px;
      font-size: 11px;
      line-height: 1.35;
      color: #666;
    }

    .modal-video-wrap {
      display: flex;
      justify-content: center;
      margin-bottom: 8px;
    }

    .modal-video {
      width: 100%;
      max-width: 230px;
      height: auto;
      max-height: 42vh;
      border-radius: 12px;
      background: #000;
      object-fit: contain;
      display: block;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .route-box {
      margin-top: 4px;
      background: #fafafa;
      border: 1px solid #ececec;
      border-radius: 12px;
      padding: 8px;
    }

    .route-title {
      font-size: 13px;
      font-weight: 700;
      color: #94134A;
      margin-bottom: 6px;
    }

    .gif-frame {
      width: 100%;
      max-width: 190px;
      height: 90px;
      margin: 0 auto;
      background: #fff;
      border: 1px solid #e6e6e6;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 4px;
    }

    .direction-gif {
      max-width: 100%;
      max-height: 100%;
      width: auto;
      height: auto;
      object-fit: contain;
      display: block;
    }

    .modal-actions {
      margin-top: 10px;
      display: flex;
      justify-content: center;
    }

    .close-btn {
      padding: 9px 22px;
      background: linear-gradient(135deg, #94134A, #7a103d);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      cursor: pointer;
      box-shadow: 0 6px 16px rgba(148, 19, 74, 0.22);
    }

    @media (max-width: 480px) {
      .modal-container {
        max-width: 300px;
        padding: 10px 10px 12px;
      }

      .modal-video {
        max-width: 205px;
        max-height: 40vh;
      }

      .gif-frame {
        max-width: 165px;
        height: 78px;
      }
    }
  </style>
</head>

<body>

  {{-- <div id="overlay">
    <button id="menuBtn" class="button" type="button">
      <i class="fa-solid fa-arrow-left"></i>
    </button>
  </div> --}}

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

  <div id="customModal" class="hidden">
    <div class="modal-container">
      {{-- <p class="modal-subtitle">
        Mira el video y sigue la referencia visual.
      </p> --}}

      <div class="modal-video-wrap">
        <video
          id="modalVideo"
          class="modal-video"
          playsinline
          webkit-playsinline
          controls
          preload="auto"
        ></video>
      </div>

      <div class="route-box">
        <div class="route-title">Ruta</div>
        <div class="gif-frame">
          <img
            id="directionGif"
            class="direction-gif"
            src="{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}"
            alt="Ruta"
          >
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="close-btn" onclick="closeModal()">Cerrar</button>
      </div>
    </div>
  </div>

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
      0: "{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}",
      1: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      2: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      3: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      4: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      5: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      6: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      7: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
      8: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      9: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      10: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      11: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      12: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      13: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      14: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
      15: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      16: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      17: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      18: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      19: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
      20: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
      21: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
      22: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
      23: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
      24: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
      25: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      26: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      27: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      28: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
      29: "{{ asset('aframe/examples/assets/murales/gifs/11-12.gif') }}",
      30: "{{ asset('aframe/examples/assets/murales/gifs/11-12.gif') }}",
      31: "{{ asset('aframe/examples/assets/murales/gifs/12-13.gif') }}"
    };

    document.addEventListener("DOMContentLoaded", () => {
      const modal = document.getElementById("customModal");
      const modalVideo = document.getElementById("modalVideo");
      const directionGif = document.getElementById("directionGif");
      const menuBtn = document.getElementById("menuBtn");

      let currentTargetIndex = null;
      let modalOpen = false;
      let openCooldown = false;

      document.querySelectorAll("[mindar-image-target]").forEach((el) => {
        const attr = el.getAttribute("mindar-image-target");
        const match = attr && attr.match(/targetIndex:\s*(\d+)/);
        if (!match) return;

        const idx = Number(match[1]);

        el.addEventListener("targetFound", () => {
          if (openCooldown) return;
          openModalForTarget(idx);
        });
      });

      function openModalForTarget(targetIndex) {
        if (modalOpen && currentTargetIndex === targetIndex) return;

        currentTargetIndex = targetIndex;
        modalOpen = true;
        openCooldown = true;

        const videoSrc = targetVideos[targetIndex];
        const gifSrc = targetDirections[targetIndex] || "{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}";

        directionGif.src = gifSrc;

        modal.classList.remove("hidden");

        if (videoSrc) {
          modalVideo.pause();
          modalVideo.src = videoSrc;
          modalVideo.currentTime = 0;
          modalVideo.muted = false;
          modalVideo.load();

          const p = modalVideo.play();
          if (p !== undefined) {
            p.catch(() => {
              modalVideo.muted = true;
              modalVideo.play().catch(() => {});
            });
          }
        }

        setTimeout(() => {
          openCooldown = false;
        }, 1200);
      }

      window.closeModal = function () {
        modal.classList.add("hidden");
        modalVideo.pause();
        modalVideo.removeAttribute("src");
        modalVideo.load();
        currentTargetIndex = null;
        modalOpen = false;
      };

      modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
      });

      menuBtn.addEventListener("click", () => {
        window.location.href = "/";
      });
    });
  </script>
</body>
</html>