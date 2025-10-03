<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    #overlay {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 20px;
      z-index: 9999;
      pointer-events: none;
    }

    #overlay button,
    #overlay audio {
      pointer-events: auto;
    }

    .button {
      padding: 10px 20px;
      background-color: #94134A;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100px;
    }

    .button:hover {
      background-color: #6e0e37;
    }

    /* MODAL */
    #customModal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.8);
      z-index: 99999;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 60px; 
      box-sizing: border-box;
    }

    .modal-container {
      background: #fff;
      padding: 16px;
      border-radius: 10px;
      color: black;
      text-align: center;
      width: 95vw;            /* 95% del ancho de pantalla */
      max-width: 500px;       /* límite en pantallas grandes */
      box-sizing: border-box;
    }

    .modal-video {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-top: 10px;
    }
  </style>
</head>

<body>

  <!-- CONTROLES SUPERIORES -->
  <div id="overlay">
    <button id="menuBtn" class="button"><i class="fa-solid fa-arrow-left"></i></button>
    <audio id="audioControl" controls></audio>
  </div>

  <!-- ESCENA A-FRAME -->
  <a-scene mindar-image="imageTargetSrc: {{ asset('aframe/examples/assets/murales1718.mind') }}; filterMinCF:0.0001; filterBeta:0.0001;"
           color-space="sRGB"
           renderer="colorManagement: true, physicallyCorrectLights"
           vr-mode-ui="enabled: false"
           device-orientation-permission-ui="enabled: false">

    <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>
    <a-entity light="type: directional; intensity: 1" position="1 1 1"></a-entity>
    <a-entity light="type: ambient; intensity: 0.5"></a-entity>

    <!-- Target 0: SOLO DISPARA MODAL -->
    <a-entity mindar-image-target="targetIndex: 0"></a-entity>

    <!-- Target 1: puede tener modelo si quieres -->
    <a-entity mindar-image-target="targetIndex: 1">
      <!-- podrías poner glTF aquí -->
    </a-entity>
  </a-scene>

  <!-- MODAL -->
  <div id="customModal">
    <div class="modal-container">
      <video 
        src="{{ asset('aframe/examples/assets/centro.mp4') }}" 
        class="modal-video"
        autoplay 
        muted 
        playsinline 
        loop 
        controls>
      </video>
      <br>
      <button onclick="closeModal()" style="padding:10px 20px; background:#94134A; color:white; border:none; border-radius:5px;">Cerrar</button>
    </div>
  </div>

  <!-- AUDIOS -->
  <audio id="idioma1" src="{{ asset('images/Español_01.mp3') }}"></audio>
  <audio id="idioma2" src="{{ asset('images/Ingles_01.mp3') }}"></audio>
  <audio id="idioma3" src="{{ asset('images/Mazahua_01.mp3') }}"></audio>
  <audio id="idioma4" src="{{ asset('images/Otomi_01.mp3') }}"></audio>
  <audio id="idioma5" src="{{ asset('images/Nahuatl_01.mp3') }}"></audio>

  <!-- SCRIPT -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      const idioma = {!! json_encode($idioma) !!};
      const audioControl = document.getElementById("audioControl");
      const alarma = document.getElementById("idioma" + idioma);
      const modal = document.getElementById("customModal");
      modal.style.display = "none";

      audioControl.src = alarma.src;
      audioControl.load();

      const target = document.querySelector("[mindar-image-target='targetIndex: 0']");

      if (target) {
        console.log('holaaa target')
        target.addEventListener("targetFound", () => {
          console.log("Target detectado");
          modal.style.display = "flex";
          audioControl.play();
        });
      }

      audioControl.addEventListener("ended", function () {
        audioControl.play();
      });

      $('#menuBtn').click(() => {
        window.location.href = "/";
      });

      window.closeModal = function () {
        modal.style.display = "none";
        audioControl.pause();
      }
    });
  </script>
</body>
</html>
