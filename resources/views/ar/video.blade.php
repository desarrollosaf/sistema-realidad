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
  width: 70%; /* Reduce el tamaño relativo */
  max-width: 300px; /* Máximo tamaño absoluto */
  height: auto;
  border-radius: 10px;
  margin-top: 10px;
}


    /* En lugar de display: none, usa la clase .hidden */
#customModal.hidden {
  display: none;
}

  </style>
</head>

<body>

  <!-- CONTROLES SUPERIORES -->
  <div id="overlay">
    <button id="menuBtn" class="button"><i class="fa-solid fa-arrow-left"></i></button>
    <!--<audio id="audioControl" controls></audio>-->
  </div>

  <!-- ESCENA A-FRAME -->
  <a-scene mindar-image="imageTargetSrc: {{ asset('aframe/examples/assets/murales/muralesFF2.mind') }}; filterMinCF:0.0001; filterBeta:0.0001;"
           color-space="sRGB"
           renderer="colorManagement: true, physicallyCorrectLights"
           vr-mode-ui="enabled: false"
           device-orientation-permission-ui="enabled: false">

    <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>
    <a-entity light="type: directional; intensity: 1" position="1 1 1"></a-entity>
    <a-entity light="type: ambient; intensity: 0.5"></a-entity>

    <!-- Target 0: SOLO DISPARA MODAL -->
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
  </a-scene>

  <!-- MODAL -->
  <div id="customModal" class="hidden">
    <div class="modal-container">
      <video 
        src="{{ asset('aframe/examples/assets/videoDGCS.mp4') }}" 
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
    const targetVideos = {
      0: "{{ asset('aframe/examples/assets/murales/01EmbrionPlastico.mp4') }}",

      1: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      2: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",
      3: "{{ asset('aframe/examples/assets/murales/02EscaleraSuryMuroOrientedelaEscaleraSur.mp4') }}",

      4: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      5: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      6: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      7: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      8: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      9: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",
      10: "{{ asset('aframe/examples/assets/murales/03MuroOrientePlantaSuperior.mp4') }}",


      11: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      12: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      13: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      14: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",
      15: "{{ asset('aframe/examples/assets/murales/04EscaleraNorte.mp4') }}",

      16: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      17: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      18: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      19: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",
      20: "{{ asset('aframe/examples/assets/murales/05MuroOrientePlantaBaja.mp4') }}",

      21: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      22: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      23: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",
      24: "{{ asset('aframe/examples/assets/murales/06MuroOrientePlantaBajaparte sur.mp4') }}",

      25: "{{ asset('aframe/examples/assets/murales/07MuroSurpuertaOriente.mp4') }}",
      26: "{{ asset('aframe/examples/assets/murales/08MuroNortepuertaOriente.mp4') }}",
      27: "{{ asset('aframe/examples/assets/murales/09Vestibuloladonorte.mp4') }}",
    };

    $(document).ready(function () {
      const idioma = {!! json_encode($idioma) !!};
      //const audioControl = document.getElementById("audioControl");
      const alarma = document.getElementById("idioma" + idioma);
      const modal = document.getElementById("customModal");
      modal.classList.add('hidden');

      //audioControl.src = alarma.src;
      //audioControl.load();

      // const target0 = document.querySelector("[mindar-image-target='targetIndex: 0']");
      // const target1 = document.querySelector("[mindar-image-target='targetIndex: 1']");
      // const target2 = document.querySelector("[mindar-image-target='targetIndex: 2']");
      // const target3 = document.querySelector("[mindar-image-target='targetIndex: 3']");
      // const target4 = document.querySelector("[mindar-image-target='targetIndex: 4']");
      // const target5 = document.querySelector("[mindar-image-target='targetIndex: 5']");
      // const target6 = document.querySelector("[mindar-image-target='targetIndex: 6']");
      // const target7 = document.querySelector("[mindar-image-target='targetIndex: 7']");
      // const target8 = document.querySelector("[mindar-image-target='targetIndex: 8']");
      // const target9 = document.querySelector("[mindar-image-target='targetIndex: 9']");
      // const target10 = document.querySelector("[mindar-image-target='targetIndex: 10']");
      // const target11 = document.querySelector("[mindar-image-target='targetIndex: 11']");
      // const target12 = document.querySelector("[mindar-image-target='targetIndex: 12']");
      // const target13 = document.querySelector("[mindar-image-target='targetIndex: 13']");
      // const target14 = document.querySelector("[mindar-image-target='targetIndex: 14']");
      // const target15 = document.querySelector("[mindar-image-target='targetIndex: 15']");
      // const target16 = document.querySelector("[mindar-image-target='targetIndex: 16']");
      // const target17 = document.querySelector("[mindar-image-target='targetIndex: 17']");


      // if (target0) {
      //   target0.addEventListener("targetFound", () => handleTargetFound(0));
      // }
      // if (target1) {
      //   target1.addEventListener("targetFound", () => handleTargetFound(1));
      // }
      // if (target2) {
      //   target2.addEventListener("targetFound", () => handleTargetFound(2));
      // }
      // if (target3) {
      //   target3.addEventListener("targetFound", () => handleTargetFound(3));
      // }
      // if (target4) {
      //   target4.addEventListener("targetFound", () => handleTargetFound(4));
      // }
      // if (target5) {
      //   target5.addEventListener("targetFound", () => handleTargetFound(5));
      // }
      // if (target6) {
      //   target6.addEventListener("targetFound", () => handleTargetFound(6));
      // }
      // if (target7) {
      //   target7.addEventListener("targetFound", () => handleTargetFound(7));
      // }
      // if (target8) {
      //   target8.addEventListener("targetFound", () => handleTargetFound(8));
      // }
      // if (target9) {
      //   target9.addEventListener("targetFound", () => handleTargetFound(9));
      // }
      // if (target10) {
      //   target10.addEventListener("targetFound", () => handleTargetFound(10));
      // }
      // if (target11) {
      //   target11.addEventListener("targetFound", () => handleTargetFound(11));
      // }
      // if (target12) {
      //   target12.addEventListener("targetFound", () => handleTargetFound(12));
      // }
      // if (target13) {
      //   target13.addEventListener("targetFound", () => handleTargetFound(13));
      // }
      // if (target14) {
      //   target14.addEventListener("targetFound", () => handleTargetFound(14));
      // }
      // if (target15) {
      //   target15.addEventListener("targetFound", () => handleTargetFound(15));
      // }
      // if (target16) {
      //   target16.addEventListener("targetFound", () => handleTargetFound(16));
      // }
      // if (target17) {
      //   target17.addEventListener("targetFound", () => handleTargetFound(17));
      // }

      document.querySelectorAll("[mindar-image-target]").forEach((el) => {
        const attr = el.getAttribute("mindar-image-target");
        // attr suele venir como: "targetIndex: 3" o similar
        const match = attr.match(/targetIndex:\s*(\d+)/);
        if (!match) return;

        const idx = Number(match[1]);
        el.addEventListener("targetFound", () => handleTargetFound(idx));
      });

      function handleTargetFound(targetIndex) {
        const videoSrc = targetVideos[targetIndex];
        if (!videoSrc) return;

        const modal = document.getElementById("customModal");
        const video = modal.querySelector("video");

        // Cambiar el src dinámicamente
        video.src = videoSrc;
        video.muted = false;
        video.load(); // Carga el nuevo video
        video.play(); // Reproduce

        // Mostrar el modal
        modal.classList.remove("hidden");
        modal.style.display = "flex";
      }

      /*audioControl.addEventListener("ended", function () {
        audioControl.play();
      });*/

      $('#menuBtn').click(() => {
        window.location.href = "/";
      });

      window.closeModal = function () {
        modal.style.display = "none";
        modal.classList.add('hidden');
        const video = modal.querySelector("video");

          video.pause();
          video.src = "";
        //audioControl.pause();
      }
    });
  </script>
</body>
</html>
