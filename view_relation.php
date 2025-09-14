<?php
include_once 'model.php';
session_start();

$pokemons = $_SESSION['pokemons'] ?? [];
$types = $_SESSION['types'] ?? [];

function findTypeById($id, $types) {
    foreach ($types as $t) if ($t->getId() == $id) return $t;
    return null;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Relations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Relation</h2>
  <div class="mb-3">
    <a href="view_pokemon.php" class="btn btn-secondary">Back to Pokemon</a>
  </div>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr><th>No</th><th>Pokemon</th><th>Species</th><th>Type</th><th>Pro</th><th>Contra</th><th>Action</th></tr>
    </thead>
    <tbody>
      <?php
        $hasAny = false;
        foreach ($pokemons as $p):
            $tid = $p->getTypeId();
            if ($tid === null) continue; // only show those that HAVE a type
            $hasAny = true;
            $type = findTypeById($tid, $types);
      ?>
      <tr>
        <td><?= $p->getId() ?></td>
        <td><?= htmlspecialchars($p->getName()) ?></td>
        <td><?= htmlspecialchars($p->getSpecies()) ?></td>
        <td><?= $type ? htmlspecialchars($type->getName()) : '-' ?></td>
        <td><?= $type ? htmlspecialchars($type->getPro()) : '-' ?></td>
        <td><?= $type ? htmlspecialchars($type->getContra()) : '-' ?></td>
        <td>
          <a href="update_relation.php?id=<?= $p->getId() ?>" class="btn btn-warning btn-sm">Update</a>
          <a href="controller.php?delete_rel_id=<?= $p->getId() ?>" class="btn btn-danger btn-sm"
             onclick="return confirm('Remove relation for <?= htmlspecialchars($p->getName()) ?>?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (!$hasAny): ?>
        <tr><td colspan="7" class="text-center">No relations to show.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <h3>Add Relation</h3>
  <form method="POST" action="controller.php" class="mb-4">
    <input type="hidden" name="add_relation" value="1">
    <div class="row g-2">
      <div class="col-md-5">
        <label class="form-label">Pokemon</label>
        <select name="pokemon_id" class="form-select" required>
          <?php foreach ($pokemons as $p): if ($p->getTypeId() === null): ?>
            <option value="<?= $p->getId() ?>"><?= htmlspecialchars($p->getName()) ?></option>
          <?php endif; endforeach; ?>
        </select>
      </div>
      <div class="col-md-5">
        <label class="form-label">Type</label>
        <select name="type_id" class="form-select" required>
          <?php foreach ($types as $t): ?>
            <option value="<?= $t->getId() ?>"><?= htmlspecialchars($t->getName()) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2 align-self-end">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
</body>
</html>
