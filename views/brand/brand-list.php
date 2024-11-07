<?php
/** @var \Smart\Resale\Entity\Brand[] $brandList */
/** @var int $page */
/** @var int $limit */
/** @var string $filter */
/** @var int $order */
/** @var int $nextOrder */
/** @var int $currentOrder */
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
                <th
                        onclick="
                                listItem(
                        <?= "'" . BRANDS_LIST_URL . "'" . ", {$page}, {$limit}, 'id', {$nextOrder},"; ?>
                        <?php echo ($currentOrder === 0) ? 1 : 0; ?>
                                )
                                ">
                    <span>ID</span>
                    <span>
                            <?php if ($currentOrder === 0 && $filter === 'id') : ?>
                                <i class="fa-solid fa-arrow-down"></i>
                            <?php elseif ($currentOrder === 1 && $filter === 'id') : ?>
                                <i class="fa-solid fa-arrow-up"></i>
                            <?php endif; ?>
                        </span>
                </th>

                <th
                        style="width: 23%;"
                        onclick="
                                listItem(
                        <?= "'" . BRANDS_LIST_URL . "'" . ", {$page}, {$limit}, 'name', {$nextOrder},"; ?>
                        <?php echo ($currentOrder === 0) ? 1 : 0; ?>
                                )
                                ">
                    <span>Marca</span>
                    <span>
                            <?php if ($currentOrder === 0 && $filter === 'name') : ?>
                                <i class="fa-solid fa-arrow-down"></i>
                            <?php elseif ($currentOrder === 1 && $filter === 'name') : ?>
                                <i class="fa-solid fa-arrow-up"></i>
                            <?php endif; ?>
                        </span>
                </th>

                <th
                        onclick="
                                listItem(
                        <?= "'" . BRANDS_LIST_URL . "'" . ", {$page}, {$limit}, 'invoicing', {$nextOrder},"; ?>
                        <?php echo ($currentOrder === 0) ? 1 : 0; ?>
                                )
                                ">
                    <span>Faturamento</span>
                    <span>
                            <?php if ($currentOrder === 0 && $filter === 'invoicing') : ?>
                                <i class="fa-solid fa-arrow-down"></i>
                            <?php elseif ($currentOrder === 1 && $filter === 'invoicing') : ?>
                                <i class="fa-solid fa-arrow-up"></i>
                            <?php endif; ?>
                        </span>
                </th>

                <th
                        onclick="
                                listItem(
                        <?= "'" . BRANDS_LIST_URL . "'" . ", {$page}, {$limit}, 'profit', {$nextOrder},"; ?>
                        <?php echo ($currentOrder === 0) ? 1 : 0; ?>
                                )
                                ">
                    <span>Lucro</span>
                    <span>
                            <?php if ($currentOrder === 0 && $filter === 'profit') : ?>
                                <i class="fa-solid fa-arrow-down"></i>
                            <?php elseif ($currentOrder === 1 && $filter === 'profit') : ?>
                                <i class="fa-solid fa-arrow-up"></i>
                            <?php endif; ?>
                        </span>
                </th>

                <th
                        onclick="
                                listItem(
                        <?= "'" . BRANDS_LIST_URL . "'" . ", {$page}, {$limit}, 'quantity_products_sold', {$nextOrder},"; ?>
                        <?php echo ($currentOrder === 0) ? 1 : 0; ?>
                                )
                                ">
                    <span>Itens vendidos</span>
                    <span>
                            <?php if ($currentOrder === 0 && $filter === 'quantity_products_sold') : ?>
                                <i class="fa-solid fa-arrow-down"></i>
                            <?php elseif ($currentOrder === 1 && $filter === 'quantity_products_sold') : ?>
                                <i class="fa-solid fa-arrow-up"></i>
                            <?php endif; ?>
                        </span>
                </th>

                <th class="tableActions"><span>Ações</span></th>
            </tr>
            </thead>
            <tbody class='lines'>

            <?php foreach ($brandList as $brand): ?>
                <tr>
                    <td><?= $brand->getId(); ?></td>
                    <td><?= $brand->getBrandName(); ?></td>
                    <td><?= $brand->getInvoicing(); ?></td>
                    <td><?= $brand->getProfit(); ?></td>
                    <td><?= $brand->getQuantityOfProductsSold(); ?></td>
                    <td>
                        <a class="actions" title='Editar' href='/edit-brand?brand=<?= $brand->getId(); ?>'><i class='fa-solid fa-pen-to-square'></i></a>
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
                                <?= ($limit >= $brandCount) ? 'Todas' : $limit ?>
                            </option>

                            <?php foreach (NUMBER_OF_LINES as $numberOfLines): ?>
                                <option
                                        value="<?= $numberOfLines; ?>"
                                        data-brands-url="<?= BRANDS_LIST_URL; ?>"
                                        data-filter="<?= $filter; ?>"
                                        data-order="<?= $order; ?>"
                                        data-current-order="<?= $currentOrder; ?>"
                                >
                                    <?= $numberOfLines; ?>
                                </option>
                            <?php endforeach; ?>

                            <option
                                    value="<?= $brandCount; ?>"
                                    data-brands-url="<?= BRANDS_LIST_URL; ?>"
                                    data-filter="<?= $filter; ?>"
                                    data-order="<?= $order; ?>"
                                    data-current-order="<?= $currentOrder; ?>"
                            >
                                Todas
                            </option>
                        </select>
                    </div>

                    <div>
                        <p>Total de marcas: <?= $brandCount; ?></p>
                    </div>
                </div>

                <div id="paginationControlsNextPage">
                    <button id="pagination_options" onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", 1, {$limit}, '{$filter}', {$order}, {$currentOrder}" ?>)">
                        <i class="fa-solid fa-backward"></i>
                    </button>

                    <?php for ($previousPage = $page - $numberOfButtonsOnPagination; $previousPage <= $page - 1; $previousPage++): ?>
                        <?php if ($previousPage >= 1): ?>
                            <button
                                    onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$previousPage}, {$limit}, '{$filter}', {$order}, {$currentOrder}" ?>)">
                                <?= $previousPage; ?>
                            </button>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <button class="activeButton"><?= $page; ?></button>

                    <?php for ($nextPage = $page + 1; $nextPage <= $page + $numberOfButtonsOnPagination; $nextPage++): ?>
                        <?php if ($nextPage <= $numberOfPages): ?>
                            <button
                                    onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$nextPage}, {$limit}, '{$filter}', {$order}, {$currentOrder}" ?>)">
                                <?= $nextPage; ?>
                            </button>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <button onclick="listItem(<?= "'" . BRANDS_LIST_URL . "'" . ", {$numberOfPages}, {$limit}, '{$filter}', {$order}, {$currentOrder}" ?>)">
                        <i class="fa-solid fa-forward"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p id="noItemsFound">Whoops... Nenhuma marca foi encontrada</p>
<?php endif; ?>
