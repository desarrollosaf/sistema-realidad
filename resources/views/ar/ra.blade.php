<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Texto en mural AR</title>

  <!-- Librerías -->
  <script src="https://cdn.jsdelivr.net/npm/three@0.152.2/build/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.4/dist/mindar-image-three.prod.js"></script>

  <style>
    html, body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      width: 100%;
      height: 100%;
      background: black;
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

  <script>
    async function startAR() {
      // Inicializar MindAR
      const mindarThree = new window.MINDAR.IMAGE.MindARThree({
        container: document.querySelector("#ar-container"),
        imageTargetSrc: "{{ asset('aframe/examples/assets/vestibulo.mind') }}" // tu .mind
      });

      const { renderer, scene, camera } = mindarThree;
      const anchor = mindarThree.addAnchor(0);

      // Crear texto como textura
      const canvas = document.createElement("canvas");
      canvas.width = 1024;
      canvas.height = 256;
      const ctx = canvas.getContext("2d");
      ctx.fillStyle = "rgba(0, 0, 0, 0.3)";
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      ctx.font = "bold 60px sans-serif";
      ctx.fillStyle = "white";
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      ctx.fillText(
        "Con las manos cubre su rostro y entre la mano izquierda podrás encontrar un ojo",
        canvas.width / 2,
        canvas.height / 2
      );

      const texture = new THREE.CanvasTexture(canvas);
      const geometry = new THREE.PlaneGeometry(1.8, 0.5);
      const material = new THREE.MeshBasicMaterial({
        map: texture,
        transparent: true,
        side: THREE.DoubleSide,
      });

      const textPlane = new THREE.Mesh(geometry, material);
      textPlane.position.set(0, -0.6, 0);
      anchor.group.add(textPlane);

      // Suavizado del movimiento
      const smoothPosition = new THREE.Vector3();
      const smoothQuaternion = new THREE.Quaternion();
      const tempPosition = new THREE.Vector3();
      const tempQuaternion = new THREE.Quaternion();

      await mindarThree.start();

      renderer.setAnimationLoop(() => {
        anchor.group.getWorldPosition(tempPosition);
        anchor.group.getWorldQuaternion(tempQuaternion);

        smoothPosition.lerp(tempPosition, 0.15);
        smoothQuaternion.slerp(tempQuaternion, 0.15);

        textPlane.position.copy(smoothPosition);
        textPlane.quaternion.copy(smoothQuaternion);

        renderer.render(scene, camera);
      });
    }

    startAR();
  </script>
</body>
</html>