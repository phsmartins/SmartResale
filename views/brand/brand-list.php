<?php
    $this->layout('layout');

    /** @var \Smart\Resale\Entity\Brand[] $brandList */
?>

<h1>Marcas cadastradas</h1>

<?php if (empty($brandList)): ?>
    <h1>Você não cadastrou nenhuma marca até agora</h1>
<?php else: ?>
    <ul>

        <?php foreach ($brandList as $brand): ?>

            <li><?= $brand->getBrandName(); ?></li>

        <?php endforeach; ?>

    </ul>
<?php endif; ?>
