
<div class="flex bg-white md:h-min-22 h-min-20	 dark:bg-gray-800 rounded-lg shadow mb-5 px-10 py-4">
    <h1 class="text-2xl block">#<?= $player->getId(); ?> <?= $player->getUsername(); ?></h1>
    <?= $player->getEmail(); ?>

    <a href="/player/show?id=<?= $player->getId(); ?>">
        <i class="fas fa-eye"></i>
    </a>
    <a href="/player/edit?id=<?= $player->getId(); ?>">
        <i class="fas fa-edit"></i>
    </a>
    <a href="/player/delete?id=<?= $player->getId(); ?>"
       onclick="return confirm('Are you sure you want to delete it?')">
        <i class="fas fa-trash"></i>
    </a>

    </td>
</div>