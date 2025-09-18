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
      top: 10px;      /* arriba de la pantalla */
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 10px 20px;
      z-index: 9999; /* siempre encima */
      pointer-events: none; /* permite tocar solo los botones */
    }
    #overlay button {
      pointer-events: auto; /* los botones sí reciben clicks */
      padding: 10px 15px;
      font-size: 16px;
      opacity: 0.8;
    }
  </style>
</head>
<body>


  <div id="overlay">
    <button id="audioBtn">🔊 Sonido</button>
    <button id="menuBtn">🏠 Menú</button>
  </div>

  <a-scene mindar-image="imageTargetSrc: https://sistemas.siasaf.gob.mx/aframe/examples/assets/targets.mind; filterMinCF:0.0001; filterBeta:0.0001"
           color-space="sRGB" 
           renderer="colorManagement: true, physicallyCorrectLights" 
           vr-mode-ui="enabled: false" 
           device-orientation-permission-ui="enabled: false">

    <a-assets>
      <a-asset-item id="avatarModel" src="https://sistemas.siasaf.gob.mx/aframe/examples/image-tracking/nft/TextMuralDGC.glb"></a-asset-item>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      const idioma = {!! json_encode($idioma) !!};
      const alarma = document.getElementById("idioma" + idioma);

      $('#audioBtn').click(() => {
        alarma.play();   
      });


      $('#menuBtn').click(() => {
        window.location.href = "/";
      });
    });
  </script>

</body>
</html>
