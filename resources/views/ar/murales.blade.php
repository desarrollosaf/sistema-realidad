<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/gh/hiukim/mind-ar-js@1.1.4/dist/mindar-image.prod.js"></script>
  <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/hiukim/mind-ar-js@1.1.4/dist/mindar-image-aframe.prod.js"></script>
  <style>
    /* Overlay arriba */
    #overlay {
      position: fixed;
      top: 10px;     
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column; /* 🔹 hace que se apilen hacia abajo */
      align-items: center;
      gap: 10px; /* separación entre botones */
      z-index: 9999;
      pointer-events: none;
    }

    #overlay button,
    #overlay audio {
      pointer-events: auto; /* los elementos sí reciben clicks */
    }

    /* Estilo de los botones */
    .button {
      padding: 10px 20px;
      background-color: #94134A;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 200px;
    }

    .button:hover {
      background-color: #6e0e37;
    }
  </style>
</head>
<body>

  <div id="overlay">
    <audio id="m" src="{{ asset('images/pleno_sound.mp3') }}" controls></audio>

    <button id="audioBtn" class="button">
      @if($idioma == 1) 
        Español 
      @elseif($idioma == 2) 
        Inglés 
      @else 
        Lenguaje 
      @endif
    </button>
    <button id="menuBtn" class="button">Regresar</button>
  </div>

  <a-scene mindar-image="imageTargetSrc: {{ asset('aframe/examples/assets/targets.mind') }}; filterMinCF:0.0001; filterBeta:0.0001;"
           color-space="sRGB" 
           renderer="colorManagement: true, physicallyCorrectLights, alpha: true" 
           vr-mode-ui="enabled: false" 
           device-orientation-permission-ui="enabled: false">

    <a-assets>
      <a-asset-item id="avatarModel" src="{{ asset('aframe/examples/image-tracking/nft/TextMuralDGC.glb') }}"></a-asset-item>
    </a-assets>

    <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>

    <a-entity light="type: directional; intensity: 1" position="1 1 1"></a-entity>
    <a-entity light="type: ambient; intensity: 0.5"></a-entity>

    <a-entity mindar-image-target="targetIndex: 0">
      <a-gltf-model rotation="0 0 0" position="-0.5 -0.6 0.1" scale="0.5 0.5 0.5" src="#avatarModel" animation-mixer></a-gltf-model>
    </a-entity>

    <a-entity mindar-image-target="targetIndex: 1">
      <a-gltf-model rotation="0 0 0" position="-0.5 -0.6 0.1" scale="0.5 0.5 0.5" src="#avatarModel" animation-mixer></a-gltf-model>
    </a-entity>

  </a-scene>

  <audio id="idioma1" src="{{ asset('images/pleno_sound.mp3') }}"></audio>
  <audio id="idioma2" src="{{ asset('images/bep.mp3') }}"></audio>
  <audio id="idioma3" src="{{ asset('images/bep2.mp3') }}"></audio>
  <audio id="idioma4" src="{{ asset('images/bep2.mp3') }}"></audio>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      const idioma = {!! json_encode($idioma) !!};
      const alarma = document.getElementById("idioma" + idioma);
      const alarmaControls = document.getElementById("m");

      $('#audioBtn').click(() => {
        alarma.play();   
      });

      alarma.addEventListener("ended", function() {
        alarma.play(); 
      });
      
      alarmaControls.addEventListener("ended", function() {
        alarmaControls.play(); 
      });

      $('#menuBtn').click(() => {
        window.location.href = "/";
      });
    });
  </script>

</body>
</html>
