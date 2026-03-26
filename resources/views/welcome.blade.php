<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Poder Legislativo del Estado de México</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      flex-direction: column;
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 24px 16px 32px;
    }

    .mobile-frame {
      width: 100%;
      max-width: 390px;
      min-height: 700px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: #ffffff;
      border-radius: 0;
      overflow: hidden;
      position: relative;
    }

    .top-area {
      padding: 28px 18px 20px;
      text-align: center;
    }

    .logos {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 14px;
      margin-bottom: 36px;
      flex-wrap: wrap;
    }

    .logos img {
      max-height: 42px;
      width: auto;
      object-fit: contain;
    }

    .card-ar {
      background: #9b0f57;
      border-radius: 14px;
      padding: 28px 22px 24px;
      color: #fff;
      text-align: center;
      margin: 0 auto 14px;
      max-width: 320px;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.10);
    }

    .icon-box {
      width: 64px;
      height: 64px;
      margin: 0 auto 18px;
      background: #fff;
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #b28747;
      font-size: 34px;
      font-weight: bold;
    }

    .card-ar h2 {
      font-size: 1.9rem;
      line-height: 1.05;
      font-weight: 800;
      margin-bottom: 12px;
    }

    .card-ar p {
      font-size: 1rem;
      line-height: 1.35;
      color: #f5eaf0;
    }

    .btn-wrap {
      max-width: 320px;
      margin: 0 auto;
    }

    .btn-start {
      display: block;
      width: 100%;
      text-align: center;
      background: #9b0f57;
      color: #fff;
      text-decoration: none;
      font-size: 1.15rem;
      font-weight: 700;
      padding: 14px 20px;
      border-radius: 4px;
      transition: 0.2s ease;
    }

    .btn-start:hover {
      background: #860d4b;
    }

    footer {
      background: #ae8449;
      color: #fff;
      padding: 18px 16px;
      text-align: center;
    }

    .footer-links {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      font-size: 15px;
    }

    .footer-links a {
      color: #fff;
      text-decoration: none;
    }

    @media (max-width: 480px) {
      .mobile-frame {
        max-width: 100%;
        min-height: 100vh;
      }

      main {
        padding: 0;
      }

      .top-area {
        padding-top: 24px;
      }

      .card-ar h2 {
        font-size: 1.7rem;
      }

      .card-ar p {
        font-size: 0.95rem;
      }
    }
  </style>
</head>

<body>
  <div class="page-wrapper">
    <main>
      <div class="mobile-frame">
        <div class="top-area">

          <div class="logos">
            {{-- <img src="{{ asset('images/logo-edomex.png') }}" alt="Edomex"> --}}
            <img src="{{ asset('images/congreso.png') }}" alt="Congreso">
          </div>
          <br><br><br><br><br><br>
          <div class="card-ar">
            <div class="icon-box">📷</div>
            <h2>Utiliza tu cámara para escanear las distintas secciones del mural</h2>
            <p>
              Dirige el marcador hacia los rostros o siluetas humanas que identifiques.
            </p>
          </div>

          <div class="btn-wrap">
            <a href="{{ route('ar.video', 1) }}" class="btn-start">Comenzar</a>
          </div>
        </div>

        <footer>
          <div class="footer-links">
            <a href="https://congresoedomex.gob.mx/" target="_blank">Poder Legislativo</a>
            <span>|</span>
            <a href="https://congresoedomex.gob.mx/" target="_blank">congresoedomex.gob.mx</a>
          </div>
        </footer>
      </div>
    </main>
  </div>
</body>
</html>