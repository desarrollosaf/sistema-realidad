<!doctype html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta property="og:description" content="Poder Legislativo del Estado de México" />
    <meta property="og:url" content="https://congresoedomex.gob.mx" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://congresoedomex.gob.mx/storage/images/EscudoLXII_Mesa.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="683" />
    <meta property="og:title" content="Poder Legislativo del Estado de México" />
    <title>Poder Legislativo del Estado de México</title>
    <link rel="shortcut icon" href="https://congresoedomex.gob.mx/storage/images/favicon.svg">
    <script defer="defer" src="https://congresoedomex.gob.mx/js/app.js"></script>
    <script defer="defer" src="https://congresoedomex.gob.mx/js/particles.js"></script>
    <link href="https://congresoedomex.gob.mx/css/app.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex-grow: 1;
        }

        body.home {
            background-image: url('{{ asset('assets/images/fondo derechos humanos-01-04.svg') }}') !important;
            background-position: top, bottom;
            background-repeat: no-repeat;
            background-size: 100%;
        }

        .pb-lg-60 {
            padding-bottom: 20px !important;
        }

        .pt-60 {
            padding-top: 20px !important;
        }

        .bg-lighter {
            --bs-bg-opacity: 1;
            background-color: #AE8449 !important;
        }

        .btn-outline-darker {
            --bs-btn-color: #FFFFFF;
            --bs-btn-border-color: #94134A;
            --bs-btn-hover-color: #FFFFFF;
            --bs-btn-hover-bg: #94134A;
            --bs-btn-hover-border-color: #94134A;
            --bs-btn-focus-shadow-rgb: 0, 0, 0;
            --bs-btn-active-color: #94134A;
            --bs-btn-active-bg: #94134A;
            --bs-btn-active-border-color: #94134A;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #94134A;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #94134A;
            --bs-gradient: none;
        }

        @font-face {
            font-family: 'Regesto Grotesk' !important;
            src: url('/fonts/RegestoGrotesk-Regular.ttf') format('truetype') !important;
            font-weight: normal !important;
            font-style: normal !important;
        }

        @font-face {
            font-family: 'Athelas';
            src: url('/fonts/Athelas.ttc') format('truetype-collection');
            font-weight: normal;
            font-style: normal;
        }

        .titulo-convocatoria {
            font-family: 'Athelas', serif;
            font-size: 41px;
            margin-bottom: -15px;
            color: #b28d5f;
        }

        .titulo-convocatoria {
            font-size: clamp(20px, 3.5vw, 36px);
            /* mínimo 20px, ideal 3.5vw, máximo 36px */
            font-weight: bold;
        }
    </style>
</head>

<body class="home">
    <div class="page-wrapper d-flex flex-column min-vh-100">
        <main class="flex-grow-1">

            <div style="text-align: center; padding: 20px; max-width: 100%; box-sizing: border-box;">

                <!-- Imagen responsive -->
                <img src="{{ asset('images/congreso.png') }}"
                    alt="Ícono Derechos Humanos"
                    style="width: 100%; max-width: 675px; height: auto; margin-bottom: 15px;">


                <div style="max-width: 1100px; margin: 0 auto;">
                    <!-- Títulos -->
                    <p class="titulo-convocatoria" style="color: #696969; text-align: center; line-height: 1.2;">
                        <span style="color: #b28d5f;"> </span><br>
                    </p>
                    <br><br>

                    <!-- Texto -->
                    <p
                        style="font-family: 'Regesto Grotesk', sans-serif; color: #88898C; font-size: 1.2rem; padding: 0 10px;">
                       
                    </p>
                    <br><br>

                    <!-- Texto -->
                    <p
                        style="font-family: 'Regesto Grotesk', sans-serif; color: #88898C; font-size: 1.2rem; padding: 0 10px;">
                       
                    </p>
                </div>



                <!-- Botones -->
                <div style="display: flex; flex-direction: column; align-items: center; gap: 24px; padding: 0 10px;">
                    <div style="max-width: 100%; width: 100%;">
                        <a href="{{ route('ar.video', 1) }}"
                            style="display: block; text-align: center; padding: 16px 32px; background-color: #94134A; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: bold; font-size: 1rem; white-space: normal; word-wrap: break-word; max-width: 400px; margin: 0 auto;">
                            Español
                        </a>
                    </div>

                    <div style="max-width: 100%; width: 100%;">
                        <a href="{{ route('ar.video', 2) }}"
                            style="display: block; text-align: center; padding: 16px 32px; background-color: #94134A; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: bold; font-size: 1rem; white-space: normal; word-wrap: break-word; max-width: 400px; margin: 0 auto;">
                            Inglés
                        </a>
                    </div>

                    <div style="max-width: 100%; width: 100%;">
                        <a href="{{ route('ar.video', 3) }}"
                            style="display: block; text-align: center; padding: 16px 32px; background-color: #94134A; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: bold; font-size: 1rem; white-space: normal; word-wrap: break-word; max-width: 400px; margin: 0 auto;">
                            Mazahua 
                        </a>
                    </div>

                    <div style="max-width: 100%; width: 100%;">
                        <a href="{{ route('ar.video', 4) }}"
                            style="display: block; text-align: center; padding: 16px 32px; background-color: #94134A; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: bold; font-size: 1rem; white-space: normal; word-wrap: break-word; max-width: 400px; margin: 0 auto;">
                            Otomí
                        </a>
                    </div>

                    <div style="max-width: 100%; width: 100%;">
                        <a href="{{ route('ar.video', 5) }}"
                            style="display: block; text-align: center; padding: 16px 32px; background-color: #94134A; color: white; border-radius: 0.5rem; text-decoration: none; font-weight: bold; font-size: 1rem; white-space: normal; word-wrap: break-word; max-width: 400px; margin: 0 auto;">
                            Náhuatl
                        </a>
                    </div>
                </div>

                <div style="clear: both;"></div>
            </div>



        </main>


        <footer>
            <div class="bg-lighter bg-opacity-50 mt-60 pt-60 pb-40 pb-lg-60 position-relative">
                <div class="container-xl">
                    <div class="d-flex flex-column flex-lg-row align-items-center">

                        <div class="col-12 col-lg-12 mb-16 mb-lg-0">
                            <nav class="d-flex justify-content-center flex-wrap"
                                style="font-size: 18px; gap: 8px; color: white;">
                                <a href="https://congresoedomex.gob.mx/" target="_blank"
                                    style="color: white; text-decoration: none;">
                                    Poder Legislativo
                                </a>
                                <span>|</span>
                                <a href="https://congresoedomex.gob.mx/" target="_blank"
                                    style="color: white; text-decoration: none;">
                                   congresoedomex.gob.mx
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
<script type="text/javascript">
    const iframe_cont = document.querySelector("iframe");
    iframe_cont.style.cssText = 'width: 100%!important;height: 28vh!important;';
</script>

</html>
