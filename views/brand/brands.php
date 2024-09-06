<?php
    $this->layout('layout');
?>

<main class="list_items container">
    <div class="list_items__title">
        <h1>Marcas</h1>
        <a href="/"><i class="fa-solid fa-plus"></i> Adicionar marca</a>
    </div>
    <hr>

    <div class="table_container">
        <table class="table table-striped">
            <thead class="column">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Faturamento</th>
                <th>Lucro</th>
                <th>Itens vendidos</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody class="lines"></tbody>
        </table>
    </div>

    <p id="noItemsFound"></p>
</main>

<script src="/javascript/paginator.js"></script>
