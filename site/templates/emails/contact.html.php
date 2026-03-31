<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    td { padding: 10px; border-bottom: 1px solid #eee; vertical-align: top; }
    td:first-child { width: 120px; font-weight: bold; color: #555; }
    h2 { color: #1a2744; border-bottom: 2px solid #c9a84c; padding-bottom: 10px; }
    h3 { color: #1a2744; margin-top: 20px; }
    p { line-height: 1.6; }
    hr { border: none; border-top: 1px solid #eee; margin: 20px 0; }
    small { color: #888; font-size: 12px; }
  </style>
</head>
<body>
  <h2>Nuovo messaggio dal sito web</h2>
  <table>
    <tr><td>Nome:</td><td><?= $name ?></td></tr>
    <tr><td>Email:</td><td><?= $email ?></td></tr>
    <tr><td>Telefono:</td><td><?= $phone ?: 'Non indicato' ?></td></tr>
    <tr><td>Oggetto:</td><td><?= $subject ?></td></tr>
  </table>
  <h3>Messaggio:</h3>
  <p><?= nl2br($text) ?></p>
  <hr>
  <p><small>Inviato tramite il modulo di contatto su avvocatozanin.it</small></p>
</body>
</html>
