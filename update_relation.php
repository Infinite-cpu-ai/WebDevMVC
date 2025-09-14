<?php
include_once 'model.php';
session_start();

$pokemons = $_SESSION['pokemons'] ?? [];
$types = $_SESSION['types'] ?? [];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$target = null;
foreach ($pokemons as $p) if ($p->getId() == $id) $target = $p;
if (!$target) die("Pokémon not found.");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Update Relation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Update Relation for <?= htmlspecialchars($target->getName()) ?></h2>
  <form method="POST" action="controller.php">
    <input type="hidden" name="update_relation" value="1">
    <input type="hidden" name="pokemon_id" value="<?= $target->getId() ?>">
    <div class="mb-3">
      <label class="form-label">Type</label>
      <select name="type_id" class="form-select" required>
        <?php foreach ($types as $t): ?>
          <option value="<?= $t->getId() ?>" <?= $t->getId() == $target->getTypeId() ? 'selected' : '' ?>>
            <?= htmlspecialchars($t->getName()) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="view_relation.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
