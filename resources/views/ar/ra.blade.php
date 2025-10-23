<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Texto fijo sobre mural</title>

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
      // Inicializa MindAR
      const mindarThree = new window.MINDAR.IMAGE.MindARThree({
        container: document.querySelector("#ar-container"),
        imageTargetSrc: "{{ asset('aframe/examples/assets/vestibulo.mind') }}"
      });

      const { renderer, scene, camera } = mindarThree;
      const anchor = mindarThree.addAnchor(0);

      // Texto sobre el mural
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

      // 💡 Fijar el texto para que no tiemble
      // Lo actualizamos solo cuando el marcador se detecta, y lo congelamos cuando se pierde
      let visible = false;

      anchor.onTargetFound = () => {
        visible = true;
        textPlane.visible = true;
      };

      anchor.onTargetLost = () => {
        visible = false;
      };

      await mindarThree.start();

      // Guardamos la última posición estable
      const stablePosition = new THREE.Vector3();
      const stableQuaternion = new THREE.Quaternion();

      renderer.setAnimationLoop(() => {
        if (visible) {
          // Guardar la última posición estable del ancla
          anchor.group.getWorldPosition(stablePosition);
          anchor.group.getWorldQuaternion(stableQuaternion);
        } else {
          // Mantener la posición y rotación previas (fijo)
          textPlane.position.copy(stablePosition);
          textPlane.quaternion.copy(stableQuaternion);
        }

        renderer.render(scene, camera);
      });
    }

    startAR();
  </script>
</body>
</html>