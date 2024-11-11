<?php
$this->layout('layout');

/** @var \Smart\Resale\Entity\Brand|null $brand */
?>

<main class="list_items container">
    <div class="list_items__title">
        <h1>Marcas</h1>
        <button id="insertionModalButton"><i class="fa-solid fa-plus"></i> Adicionar marca</button>
    </div>
    <hr>

    <div class="searchBox">
        <label for="inputSearchBrand">Buscar marca por nome:</label>
        <input type="text" placeholder="Nome da marca" id="inputSearchBrand" >
    </div>

    <div>
        <span class="list_items_js"></span>
    </div>

    <div id="insertionModal" class="animationModal">
        <div class="modalTitle">
            <h2><i class="fa-solid fa-plus"></i> Adicionar marca</h2>
            <p id="closeInsertionModel" title="Fechar"><i class="fa-solid fa-xmark"></i></p>
        </div>

        <?php if (array_key_exists('error_message', $_SESSION)): ?>
            <p class="errorMessageModal">
                <?= $_SESSION['error_message'] ?>
            </p>
        <?php endif; ?>

        <form class="modalForm" method="post" action="/add-brand">
            <div class="input_box_modal">
                <label for="name">Marca</label>
                <input type="text" name="name" id="name" placeholder="Informe o nome da marca">
            </div>

            <div class="input_box_modal">
                <label for="description">Descrição (opcional)</label>
                <input
                        type="text"
                        name="description"
                        id="description"
                        placeholder="Descrição da marca"
                        value="<?= isset($_SESSION['description_brand']) ? htmlspecialchars($_SESSION['description_brand']) : ''; ?>"
                >
            </div>

            <div class="button_box_modal">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>

    <?php if (array_key_exists('brand_id_edit', $_SESSION)): ?>

        <div id="editModal" class="animationModal">
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
                <input type="hidden" name="brand_id" value="<?= $brand?->getId(); ?>">

                <div class="input_box_modal">
                    <label for="name">Marca</label>
                    <input
                            value="<?= $brand?->getBrandName(); ?>"
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
                            value="<?= $brand?->getDescription(); ?>"
                    >
                </div>

                <div class="button_box_modal">
                    <button type="submit">Editar</button>
                </div>
            </form>
        </div>
        <div id="editModalOverflow"></div>

        <script src="/javascript/editModal.js"></script>

    <?php endif; ?>

    <div id="modalOverflow"></div>
</main>

<script src="/javascript/paginator.js"></script>
<script src="/javascript/insertionModal.js"></script>

<?php if (array_key_exists('modal_brand_error', $_SESSION) && $_SESSION['modal_brand_error'] == 1): ?>
    <script>
        errorModal();
    </script>
<?php endif; ?>

<?php
unset($_SESSION['error_message']);
unset($_SESSION['description_brand']);
unset($_SESSION['modal_brand_error']);
unset($_SESSION['brand_id_edit']);
?>
