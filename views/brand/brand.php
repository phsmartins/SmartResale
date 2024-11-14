<?php
$this->layout('layout');

/** @var \Smart\Resale\Entity\Brand $brand */
?>

<link rel="stylesheet" href="/style/brand.css">

<main>
    <div class="headerViewSingleItem">
        <h1><?= $brand->getBrandName(); ?></h1>

        <button id="editItemButton"><i class="fa-solid fa-pen-to-square"></i> Editar marca</button>
    </div>

    <hr>

    <div class="main_info">
        <canvas id="myChart"></canvas>

        <div class="verticalLine"></div>

        <div class="general_info">
            <h2>Informações gerais</h2>

            <div class="single_info">
                <p>Faturamento:</p>
                <p class="single_info__data"><?= $brand->getInvoicing(); ?></p>
            </div>

            <div class="single_info">
                <p>Lucro:</p>
                <p class="single_info__data"><?= $brand->getProfit(); ?></p>
            </div>

            <div class="single_info">
                <p>Produtos vendidos:</p>
                <p class="single_info__data"><?= $brand->getQuantityOfProductsSold(); ?></p>
            </div>

            <div class="single_info">
                <p>Produtos cadastrados:</p>
                <p class="single_info__data"><?= $brand->getNumberRegisteredProducts(); ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Faturamento',
                    data: [
                        6000,
                        4000,
                        8000,
                        3000,
                        1000,
                        2000,
                        6000,
                        4000,
                        2000,
                        1600,
                        5000,
                        3000,
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Faturamento - 2024',
                        font: {
                            size: 24,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL'
                                }).format(value);
                            }
                        }
                    }
                }
            }
        });
    </script>

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
