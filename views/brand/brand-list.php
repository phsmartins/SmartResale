<?php
    /** @var \Smart\Resale\Entity\Brand[] $brandList */
    /** @var int $page */
    /** @var int $limit */
    /** @var string $filter */
    /** @var int $numberOfPages */
    /** @var int $numberOfButtonsOnPagination */
    /** @var int $brandCount */

    require_once __DIR__ . "/../../support/url-list.php";
?>

<?php if (!empty($brandList)) : ?>
    <div class='table_container'>
        <table class='table table-striped'>
            <thead class='column'>
                <tr>
                    <th>ID</th>
                    <th
                        style="width: 23%;"
                        onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$page}," . NUMBER_OF_LINES[0]; ?>, 'name')">
                        Marca
                    </th>
                    <th>Faturamento</th>
                    <th>Lucro</th>
                    <th>Itens vendidos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class='lines'>

                <?php foreach ($brandList as $brand): ?>
                    <tr>
                        <td><?= $brand->getId(); ?></td>
                        <td><?= $brand->getBrandName(); ?></td>
                        <td>R$ 15000,00</td>
                        <td>R$ 1000,00</td>
                        <td>16</td>
                        <td>
                            <a class="actions" title='Editar' href='/?<?= $brand->getId(); ?>'><i class='fa-solid fa-pen-to-square'></i></a>
                            <a class="actions" title='Deletar' href='/?<?= $brand->getId(); ?>'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <?php if ($brandCount > 10): ?>
            <div id="paginationControls">
                <div id="paginationControlNumberPage">
                    <div>
                        <label for="paginationControlNumberPageOptions">Quantidade de linhas:</label>
                        <select id="paginationControlNumberPageOptions">
                            <option disabled selected>
                                <?= ($limit == $brandCount) ? 'Todas' : $limit ?>
                            </option>

                            <option onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1," . NUMBER_OF_LINES[0] ?>)">
                                <?= NUMBER_OF_LINES[0]; ?>
                            </option>

                            <option onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1," . NUMBER_OF_LINES[1] ?>)">
                                <?= NUMBER_OF_LINES[1]; ?>
                            </option>

                            <option onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1," . NUMBER_OF_LINES[2] ?>)">
                                <?= NUMBER_OF_LINES[2]; ?>
                            </option>

                            <option onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1," . NUMBER_OF_LINES[3] ?>)">
                                <?= NUMBER_OF_LINES[3]; ?>
                            </option>

                            <option onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1," . $brandCount ?>)">
                                Todas
                            </option>
                        </select>
                    </div>

                    <div>
                        <p>Total de marcas: <?= $brandCount; ?></p>
                    </div>
                </div>

                <div id="paginationControlsNextPage">
                    <button id="pagination_options" onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1, {$limit}" ?>)">
                        <i class="fa-solid fa-backward"></i>
                    </button>

                    <?php for ($previousPage = $page - $numberOfButtonsOnPagination; $previousPage <= $page - 1; $previousPage++): ?>
                        <?php if ($previousPage >= 1): ?>
                            <button
                                onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$previousPage}, {$limit}" ?>)">
                                <?= $previousPage; ?>
                            </button>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <button class="activeButton"><?= $page; ?></button>

                    <?php for ($nextPage = $page + 1; $nextPage <= $page + $numberOfButtonsOnPagination; $nextPage++): ?>
                        <?php if ($nextPage <= $numberOfPages): ?>
                            <button
                                    onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$nextPage}, {$limit}" ?>)">
                                <?= $nextPage; ?>
                            </button>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <button onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$numberOfPages}, {$limit}" ?>)">
                        <i class="fa-solid fa-forward"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p id="noItemsFound">Whoops... Nenhuma marca foi encontrada</p>
<?php endif; ?>
