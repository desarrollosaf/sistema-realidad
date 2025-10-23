<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AR Mural - VKM</title>

    <!-- Librerías necesarias -->
    <script src="https://cdn.jsdelivr.net/npm/three@0.152.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.4/dist/mindar-image-three.prod.js"></script>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100%;
            width: 100%;
            background: #000;
        }
        #ar-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div id="ar-container"></div>

    <script>
        // Inicializar MindAR
        const mindarThree = new window.MINDAR.IMAGE.MindARThree({
            container: document.querySelector("#ar-container"),
            imageTargetSrc: "{{ asset('aframe/examples/assets/vestibulo.mind') }}"
        });

        const { renderer, scene, camera } = mindarThree;

        // Crear un ancla para el target detectado
        const anchor = mindarThree.addAnchor(0);

        // Crear canvas con texto
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

        // Crear textura y plano 3D
        const texture = new THREE.CanvasTexture(canvas);
        const geometry = new THREE.PlaneGeometry(1.8, 0.45); // tamaño del texto
        const material = new THREE.MeshBasicMaterial({
            map: texture,
            transparent: true,
            side: THREE.DoubleSide,
        });

        const textPlane = new THREE.Mesh(geometry, material);
        textPlane.position.set(0, -0.6, 0); // posición relativa al centro de la imagen
        anchor.group.add(textPlane);

        // Iniciar MindAR
        mindarThree.start().then(() => {
            renderer.setAnimationLoop(() => {
                renderer.render(scene, camera);
            });
        });
    </script>
</body>
</html>