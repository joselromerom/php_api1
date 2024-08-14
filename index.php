<?php

const API_URL = "https://whenisthenextmcufilm.com/api";

// Inicializar un sesión de cURL. ch = cURL handle
$ch = curl_init(API_URL);

// Inidicar que el resultado devuelto y no mostrado en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la peticion
$response = curl_exec($ch);

// Alternativa a cURL, si solo se necesita un GET:
//$response = file_get_contents(API_URL);

// Convertir el resultado a un array asociativo
$data = json_decode($response, true);
//var_dump($data);

// Cerrar la conexión
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light dark" />
  <meta name="description" content="La próxima película de Marvel" />
  <title>La próxima película de Marvel - Jonatandb</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
  <style>
    body {
      display: grid;
      place-content: center;
    }

    section {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    img {
      margin-bottom: 10px;
    }
  </style>
</head>


<body>

  <main>

    <section>
      <article>
        <h2>¿Cuándo es la próxima película de Marvel?</h2>
      </article>
    </section>

    <section>
      <img src="<?= $data["poster_url"] ?>" alt="Poster de<?= $data["title"] ?>" width="200" style="border-radius: 16px;">
      <article>
        <h3><?= $data["title"] ?> se estrena en <i><?= $data["days_until"] ?></i> días!</h3>
        <hr />
        <p>Fecha de estreno: <?= date('d/m/Y', strtotime($data["release_date"])) ?></p>
        <p>La siguiente es: "<?= $data["following_production"]["title"] ?>"</p>
      </article>
    </section>

    <!--
      <pre style="font-size: 14px; overflow: scroll; height: 250px">
        <?php var_dump($data); ?>
      </pre>
    -->

  </main>

</body>

</html>