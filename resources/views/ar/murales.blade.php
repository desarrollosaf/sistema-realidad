<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.jsdelivr.net/gh/hiukim/mind-ar-js@1.1.4/dist/mindar-image.prod.js"></script>
    <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/hiukim/mind-ar-js@1.1.4/dist/mindar-image-aframe.prod.js"></script>
  </head>
  <body>
    <a-scene mindar-image="imageTargetSrc: https://sistemas.siasaf.gob.mx/aframe/examples/assets/targets.mind; filterMinCF:0.0001; filterBeta:0.0001"
             color-space="sRGB" 
             renderer="colorManagement: true, physicallyCorrectLights" 
             vr-mode-ui="enabled: false" 
             device-orientation-permission-ui="enabled: false">
      
      <a-assets>
        <a-asset-item id="avatarModel" src="https://sistemas.siasaf.gob.mx/aframe/examples/image-tracking/nft/TextMuralDGC.glb"></a-asset-item>
        <audio id="audio1" src="https://cdn.aframe.io/basic-guide/audio/backgroundnoise.wav"></audio>
      </a-assets>

      <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>

      <!-- Luces -->
      <a-entity light="type: directional; intensity: 1" position="1 1 1"></a-entity>
      <a-entity light="type: ambient; intensity: 0.5"></a-entity>

      <a-entity mindar-image-target="targetIndex: 0">
        <a-gltf-model 
          rotation="0 0 0" 
          position="-0.5 -0.6 0.1" 
          scale="0.5 0.5 0.5" 
          src="#avatarModel"
          animation-mixer>
        </a-gltf-model>
        <a-entity sound="src: #audio1; autoplay: true; loop: true; positional: false"></a-entity>
      </a-entity>

      <a-entity mindar-image-target="targetIndex: 1">
        <a-gltf-model 
          rotation="0 0 0" 
          position="-0.5 -0.6 0.1" 
          scale="0.5 0.5 0.5" 
          src="#avatarModel"
          animation-mixer>
        </a-gltf-model>
        <a-entity sound="src: #audio1; autoplay: true; loop: true; positional: false"></a-entity>
      </a-entity>

    </a-scene>
  </body>
</html>
