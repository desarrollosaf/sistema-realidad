<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
 
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
  </style>
</head>
<body>

  <div id="overlay">
    <button id="menuBtn" class="button"><i class="fa-solid fa-arrow-left"></i></button>

    <audio id="audioControl" controls></audio>
  </div>

  <a-scene mindar-image="imageTargetSrc: {{ asset('aframe/examples/assets/qr.mind') }}; filterMinCF:0.001; filterBeta:0.001;"
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
      <a-gltf-model rotation="0 0 0" position="-0.5 1 1" scale="2 2 2" src="#avatarModel" animation-mixer></a-gltf-model>
    </a-entity>

    <a-entity mindar-image-target="targetIndex: 1">
      <a-gltf-model rotation="0 0 0" position="-0.5 1 1" scale="2 2 2" src="#avatarModel" animation-mixer></a-gltf-model>
    </a-entity>

  </a-scene>

  <audio id="idioma1" src="{{ asset('images/Español_01.mp3') }}"></audio>
  <audio id="idioma2" src="{{ asset('images/Ingles_01.mp3') }}"></audio>
  <audio id="idioma3" src="{{ asset('images/Mazahua_01.mp3') }}"></audio>
  <audio id="idioma4" src="{{ asset('images/Otomi_01.mp3') }}"></audio>
  <audio id="idioma5" src="{{ asset('images/Nahuatl_01.mp3') }}"></audio>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      const idioma = {!! json_encode($idioma) !!};
      const audioControl = document.getElementById("audioControl");
      const alarma = document.getElementById("idioma" + idioma);

      audioControl.src = alarma.src;
      audioControl.load(); 
      audioControl.play(); 
      
      audioControl.addEventListener("ended", function() {
        audioControl.play();
      });
      

      $('#menuBtn').click(() => {
        window.location.href = "/";
      });
    });
  </script>

</body>
</html>
