<?php
include_once 'model.php';
session_start();

// ensure defaults if someone opens this view first
if (!isset($_SESSION['initialized'])) {
    // same default block as controller (keamanan kalau dibuka langsung)
    $_SESSION['types'] = [
        new Type(1, "Electric", "Strong vs Water", "Weak vs Ground"),
        new Type(2, "Fire", "Strong vs Grass", "Weak vs Water"),
        new Type(3, "Grass", "Strong vs Water", "Weak vs Fire")
    ];
    $_SESSION['pokemons'] = [
        new Pokemon(1, "Pikachu", 6.0, "Mouse", 1),
        new Pokemon(2, "Charmander", 8.5, "Lizard", 2),
        new Pokemon(3, "Bulbasaur", 6.9, "Seed", 3),
        new Pokemon(4, "Eevee", 6.5, "Evolution", null)
    ];
    $_SESSION['next_pokemon_id'] = 5;
    $_SESSION['next_type_id'] = 4;
    $_SESSION['initialized'] = true;
}

$pokemons = $_SESSION['pokemons'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pokemon List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Pokemon List</h2>
  <div class="mb-3">
    <a href="view_add.php" class="btn btn-success">Add Pokemon</a>
    <a href="view_relation.php" class="btn btn-primary">View Relations</a>
  </div>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr><th>No</th><th>Name</th><th>Weight</th><th>Species</th><th>Action</th></tr>
    </thead>
    <tbody>
      <?php if (!empty($pokemons)): ?>
        <?php foreach ($pokemons as $p): ?>
        <tr>
          <td><?= $p->getId() ?></td>
          <td><?= htmlspecialchars($p->getName()) ?></td>
          <td><?= htmlspecialchars($p->getWeight()) ?></td>
          <td><?= htmlspecialchars($p->getSpecies()) ?></td>
          <td>
            <a href="update.php?id=<?= $p->getId() ?>" class="btn btn-warning btn-sm">Update</a>
            <a href="controller.php?delete_id=<?= $p->getId() ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Delete <?= htmlspecialchars($p->getName()) ?>?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" class="text-center">No Pokemon yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
