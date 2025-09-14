<?php
include_once 'model.php';
session_start();

$pokemons = $_SESSION['pokemons'] ?? [];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$target = null;
foreach ($pokemons as $p) if ($p->getId() == $id) $target = $p;
if (!$target) die("Pokémon not found.");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Update Pokemon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Update Pokemon</h2>
  <form method="POST" action="controller.php">
    <input type="hidden" name="update_pokemon" value="1">
    <input type="hidden" name="id" value="<?= $target->getId() ?>">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($target->getName()) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Weight</label>
      <input type="number" step="0.1" name="weight" class="form-control" value="<?= htmlspecialchars($target->getWeight()) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Species</label>
      <input type="text" name="species" class="form-control" value="<?= htmlspecialchars($target->getSpecies()) ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="view_pokemon.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
