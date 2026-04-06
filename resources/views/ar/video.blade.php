<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
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
      background: rgba(0, 0, 0, 0.82);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 14px;
    }

    #customModal.hidden {
      display: none;
    }

    .modal-container {
      width: 100%;
      max-width: 370px;
      max-height: 90vh;
      overflow-y: auto;
      background: #fff;
      border-radius: 20px;
      padding: 14px;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
      text-align: center;
      animation: fadeUp .25s ease;
      scrollbar-width: thin;
    }

    .modal-container::-webkit-scrollbar {
      width: 6px;
    }

    .modal-container::-webkit-scrollbar-thumb {
      background: rgba(148, 19, 74, 0.35);
      border-radius: 10px;
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
      margin: 0 0 10px;
      font-size: 12px;
      color: #666;
      line-height: 1.35;
      padding: 0 4px;
    }

    .modal-video-wrap {
      width: 100%;
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
    }

    .modal-video {
      width: 100%;
      max-width: 250px;
      max-height: 35vh;
      border-radius: 14px;
      background: #000;
      box-shadow: 0 8px 20px rgba(0,0,0,0.14);
      object-fit: cover;
    }

    .direction-card {
      background: #fafafa;
      border: 1px solid #ececec;
      border-radius: 14px;
      padding: 10px;
    }

    .direction-title {
      font-size: 14px;
      font-weight: 700;
      color: #94134A;
      margin-bottom: 6px;
    }

    .direction-text {
      font-size: 12px;
      color: #555;
      margin-bottom: 8px;
      line-height: 1.35;
      min-height: 34px;
    }

    .gif-frame {
      width: 100%;
      max-width: 230px;
      height: 125px;
      margin: 0 auto;
      background: #fff;
      border: 1px solid #e8e8e8;
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 6px;
    }

    .direction-gif {
      max-width: 100%;
      max-height: 100%;
      width: auto;
      height: auto;
      display: block;
      object-fit: contain;
    }

    .modal-actions {
      margin-top: 12px;
      display: flex;
      justify-content: center;
    }

    .close-btn {
      padding: 10px 24px;
      background: linear-gradient(135deg, #94134A, #7a103d);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
      box-shadow: 0 6px 16px rgba(148, 19, 74, 0.22);
    }

    @media (max-width: 480px) {
      .modal-container {
        max-width: 350px;
        max-height: 88vh;
        padding: 12px;
      }

      .modal-video {
        max-width: 235px;
        max-height: 33vh;
      }

      .gif-frame {
        max-width: 215px;
        height: 115px;
      }

      .direction-text {
        font-size: 11px;
      }
    }
  </style>
</head>

<body>

  <div id="overlay">
    <button id="menuBtn" class="button">
      <i class="fa-solid fa-arrow-left"></i>
    </button>
  </div>

  <a-scene
    mindar-image="imageTargetSrc: {{ asset('aframe/examples/assets/murales/muralesFF3.mind') }}; filterMinCF:0.0001; filterBeta:0.0001;"
    color-space="sRGB"
    renderer="colorManagement: true, physicallyCorrectLights"
    vr-mode-ui="enabled: false"
    device-orientation-permission-ui="enabled: false"
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
      <p class="modal-subtitle">
        Mira el video y después sigue la indicación visual para dirigirte al punto correcto.
      </p>

      <div class="modal-video-wrap">
        <video
          id="modalVideo"
          class="modal-video"
          autoplay
          playsinline
          controls
        ></video>
      </div>

      <div class="direction-card">
        <div class="direction-title">¿Hacia dónde ir?</div>

        <div class="direction-text" id="directionText">
          Sigue la referencia visual mostrada abajo para ubicarte mejor dentro del edificio.
        </div>

        <div class="gif-frame">
          <img
            id="directionGif"
            class="direction-gif"
            src="{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}"
            alt="Indicador de dirección"
          >
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" onclick="closeModal()" class="close-btn">Cerrar</button>
      </div>
    </div>
  </div>

  <audio id="idioma1" src="{{ asset('images/Español_01.mp3') }}"></audio>
  <audio id="idioma2" src="{{ asset('images/Ingles_01.mp3') }}"></audio>
  <audio id="idioma3" src="{{ asset('images/Mazahua_01.mp3') }}"></audio>
  <audio id="idioma4" src="{{ asset('images/Otomi_01.mp3') }}"></audio>
  <audio id="idioma5" src="{{ asset('images/Nahuatl_01.mp3') }}"></audio>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      0: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}",
        text: "Dirígete al vestíbulo, lado sur, mural “El Embrión Plástico”."
      },

      1: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },
      2: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },
      3: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },
      4: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },
      5: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },
      6: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },
      7: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/1-2.gif') }}",
        text: "Sigue hacia la escalera sur y ubica el muro oriente."
      },

      8: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },
      9: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },
      10: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },
      11: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },
      12: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },
      13: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },
      14: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/3-4-5-6-7.gif') }}",
        text: "Continúa y ubica el siguiente punto en planta alta."
      },

      15: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
        text: "Dirígete al siguiente tramo indicado."
      },
      16: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
        text: "Dirígete al siguiente tramo indicado."
      },
      17: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
        text: "Dirígete al siguiente tramo indicado."
      },
      18: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
        text: "Dirígete al siguiente tramo indicado."
      },
      19: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/7-8.gif') }}",
        text: "Dirígete al siguiente tramo indicado."
      },

      20: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
        text: "Ubica el recorrido señalado en el plano."
      },
      21: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
        text: "Ubica el recorrido señalado en el plano."
      },
      22: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
        text: "Ubica el recorrido señalado en el plano."
      },
      23: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
        text: "Ubica el recorrido señalado en el plano."
      },
      24: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/9-10.gif') }}",
        text: "Ubica el recorrido señalado en el plano."
      },

      25: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
        text: "Sigue la ruta del plano para llegar al punto."
      },
      26: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
        text: "Sigue la ruta del plano para llegar al punto."
      },
      27: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
        text: "Sigue la ruta del plano para llegar al punto."
      },
      28: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/10-11.gif') }}",
        text: "Sigue la ruta del plano para llegar al punto."
      },

      29: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/11-12.gif') }}",
        text: "Continúa hacia la siguiente ubicación marcada."
      },
      30: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/11-12.gif') }}",
        text: "Continúa hacia la siguiente ubicación marcada."
      },

      31: {
        gif: "{{ asset('aframe/examples/assets/murales/gifs/12-13.gif') }}",
        text: "Este es el último tramo del recorrido indicado."
      }
    };

    $(document).ready(function () {
      const modal = document.getElementById("customModal");
      const modalVideo = document.getElementById("modalVideo");
      const directionGif = document.getElementById("directionGif");
      const directionText = document.getElementById("directionText");
      const menuBtn = document.getElementById("menuBtn");

      let currentTargetIndex = null;
      let modalOpen = false;
      let openCooldown = false;

      modal.classList.add("hidden");

      document.querySelectorAll("[mindar-image-target]").forEach((el) => {
        const attr = el.getAttribute("mindar-image-target");
        const match = attr && attr.match(/targetIndex:\s*(\d+)/);
        if (!match) return;

        const idx = Number(match[1]);

        el.addEventListener("targetFound", () => {
          if (openCooldown) return;
          handleTargetFound(idx);
        });
      });

      function handleTargetFound(targetIndex) {
        if (modalOpen && currentTargetIndex === targetIndex) return;

        currentTargetIndex = targetIndex;
        modalOpen = true;
        openCooldown = true;

        const videoSrc = targetVideos[targetIndex];
        const directionData = targetDirections[targetIndex] || {
          gif: "{{ asset('aframe/examples/assets/murales/gifs/1.gif') }}",
          text: "Sigue la referencia visual para llegar al mural correspondiente."
        };

        directionGif.src = directionData.gif;
        directionText.textContent = directionData.text;

        if (videoSrc) {
          modalVideo.pause();
          modalVideo.src = videoSrc;
          modalVideo.muted = false;
          modalVideo.load();

          const playPromise = modalVideo.play();
          if (playPromise !== undefined) {
            playPromise.catch(() => {
              modalVideo.muted = true;
              modalVideo.play().catch(() => {});
            });
          }
        }

        modal.classList.remove("hidden");

        setTimeout(() => {
          openCooldown = false;
        }, 1200);
      }

      menuBtn.addEventListener("click", () => {
        window.location.href = "/";
      });

      window.closeModal = function () {
        modal.classList.add("hidden");
        modalVideo.pause();
        modalVideo.removeAttribute("src");
        modalVideo.load();
        currentTargetIndex = null;
        modalOpen = false;
      };

      modal.addEventListener("click", function (e) {
        if (e.target === modal) {
          closeModal();
        }
      });
    });
  </script>
</body>
</html>