<?php
    $this->layout('layout');
?>

<main class="list_items container">
    <div class="list_items__title">
        <h1>Marcas</h1>
        <button id="insertionModalButton"><i class="fa-solid fa-plus"></i> Adicionar marca</button>
    </div>
    <hr>

    <div>
        <span class="list_items_js"></span>
    </div>

    <div id="insertionModal" class="animationModal">
        <div class="modalTitle">
            <h2><i class="fa-solid fa-plus"></i> Adicionar marca</h2>
            <p id="closeInsertionModel" title="Fechar"><i class="fa-solid fa-xmark"></i></p>
        </div>

        <form class="modalForm" method="post" action="/add-brand">
            <div class="input_box_modal">
                <label for="name">Marca</label>
                <input type="text" name="name" id="name" placeholder="Informe o nome da marca">
            </div>

            <div class="input_box_modal">
                <label for="description">Descrição (opcional)</label>
                <input type="text" name="description" id="description" placeholder="Descrição da marca">
            </div>

            <div class="button_box_modal">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
    <div id="modalOverflow"></div>
</main>

<script src="/javascript/paginator.js"></script>
<script src="/javascript/modal.js"></script>
