<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Texto en mural - MindAR</title>
    <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.4/dist/mindar-image-three.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.152.2/build/three.min.js"></script>
    <style>
      html, body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        height: 100%;
        width: 100%;
      }
      #ar-container {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
      }
    </style>
  </head>
  <body>
    <div id="ar-container"></div>

    <script type="module">
      import { MindARThree } from "https://cdn.jsdelivr.net/npm/mind-ar@1.1.4/dist/mindar-image-three.prod.js";

      // Inicializar MindAR
      const mindarThree = new MindARThree({
        container: document.querySelector("#ar-container"),
        imageTargetSrc: "{{ asset('aframe/examples/assets/vestibulo.mind') }}"
      });

      const { renderer, scene, camera } = mindarThree;

      // Crear un ancla para el target (imagen detectada)
      const anchor = mindarThree.addAnchor(0);

      // Crear un canvas para escribir el texto como textura
      const canvas = document.createElement("canvas");
      canvas.width = 1024;
      canvas.height = 256;
      const ctx = canvas.getContext("2d");

      ctx.fillStyle = "rgba(0, 0, 0, 0.3)";
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      ctx.font = "bold 60px sans-serif";
      ctx.fillStyle = "white";
      ctx.textAlign = "center";
      ctx.fillText(
        "con las manos cubre su rostro y entre la mano izquierda podrás encontrar un ojo",
        canvas.width / 2,
        canvas.height / 2
      );

      // Crear textura con el canvas
      const texture = new THREE.CanvasTexture(canvas);

      // Crear plano para el texto
      const geometry = new THREE.PlaneGeometry(1.5, 0.4); // ancho y alto
      const material = new THREE.MeshBasicMaterial({
        map: texture,
        transparent: true,
        side: THREE.DoubleSide,
      });

      const textPlane = new THREE.Mesh(geometry, material);
      textPlane.position.set(0, -0.6, 0); // posición debajo del centro del target
      anchor.group.add(textPlane);

      // Iniciar MindAR
      await mindarThree.start();
      renderer.setAnimationLoop(() => {
        renderer.render(scene, camera);
      });
    </script>
  </body>
</html>