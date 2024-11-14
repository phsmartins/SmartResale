<?php
$this->layout('layout');

/** @var \Smart\Resale\Entity\Brand $brand */
?>

<main>
    <div class="headerViewSingleItem">
        <h1><?= $brand->getBrandName(); ?></h1>

        <button id="editItemButton"><i class="fa-solid fa-pen-to-square"></i> Editar marca</button>
    </div>

    <hr>

    <h1>(Tela em desenvolvimento)</h1>

    <div style="display: none" id="editModal" class="animationModal">
        <div class="modalTitle">
            <h2><i class="fa-solid fa-pen-to-square"></i> Editar marca</h2>
            <p id="closeEditModel" title="Fechar"><i class="fa-solid fa-xmark"></i></p>
        </div>

        <?php if (array_key_exists('error_message', $_SESSION)): ?>
            <p class="errorMessageModal">
                <?= $_SESSION['error_message'] ?>
            </p>
        <?php endif; ?>

        <form class="modalForm" method="post" action="/edit-brand">
            <input type="hidden" name="editBrandInput" value="single_brand">
            <input type="hidden" name="brand_id" value="<?= $brand->getId(); ?>">

            <div class="input_box_modal">
                <label for="name">Marca</label>
                <input
                        value="<?= $brand->getBrandName(); ?>"
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Informe o nome da marca"
                >
            </div>

            <div class="input_box_modal">
                <label for="description">Descrição (opcional)</label>
                <input
                        type="text"
                        name="description"
                        id="description"
                        placeholder="Descrição da marca"
                        value="<?= $brand->getDescription(); ?>"
                >
            </div>

            <div class="button_box_modal">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>

    <div style="display: none" id="editModalOverflow">
</main>

<script src="/javascript/editModal.js"></script>

<script>
    const editModalItem = document.querySelector('#editModal');
    const editModalOverflowItem = document.querySelector('#editModalOverflow');
    const editItemButtonItem = document.querySelector('#editItemButton');

    editItemButtonItem.addEventListener('click', () => {
        editModalItem.style.display = 'block';
        editModalOverflowItem.style.display = 'block';
    });
</script>
