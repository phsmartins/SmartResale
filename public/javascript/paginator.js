const tbody = document.querySelector(".list_items_js");
let inputSearchBrand;
let paginationControl;
let noResultsMessage;

// Função para listar os itens
const listItem = async (url, page, limit, filter, order, currentOrder) => {
    const response = await fetch(`${url}?page=${page}&limit=${limit}&filter=${filter}&order=${order}&current_order=${currentOrder}`);
    tbody.innerHTML = await response.text();

    // Inicializa o input, controle de paginação e mensagem de "Nenhum item encontrado"
    initializeSearch();
    initializePagination();
    initializeNoResultsMessage();
}

// Inicializa o input de busca
const initializeSearch = () => {
    inputSearchBrand = document.querySelector('#inputSearchBrand');

    if (!inputSearchBrand) return;

    // Remove event listeners anteriores
    inputSearchBrand.removeEventListener("input", handleSearch);
    inputSearchBrand.removeEventListener("click", handleInputClick);

    // Adiciona novos event listeners
    inputSearchBrand.addEventListener("input", handleSearch);
    inputSearchBrand.addEventListener("click", handleInputClick);
}

// Inicializa a mensagem de "Nenhum item encontrado"
const initializeNoResultsMessage = () => {
    noResultsMessage = document.querySelector("#noResultsMessage");

    // Se a mensagem não existir, cria o elemento
    if (!noResultsMessage) {
        noResultsMessage = document.createElement("div");
        noResultsMessage.id = "noResultsMessage";
        noResultsMessage.textContent = "Whoops... Nenhum item encontrado";
        noResultsMessage.style.display = "none";
        noResultsMessage.style.color = "#757575";
        noResultsMessage.style.textAlign = "center";
        noResultsMessage.style.fontSize = "1.8rem"
        tbody.parentElement.appendChild(noResultsMessage);
    }
}

// Função para lidar com a busca
const handleSearch = () => {
    const inputValue = inputSearchBrand.value.toLowerCase();
    const rows = document.querySelectorAll('.lines tr');
    let hasVisibleRows = false;

    rows.forEach(row => {
        const brandName = row.querySelectorAll('td')[1]?.textContent.toLowerCase();
        if (brandName && brandName.includes(inputValue)) {
            row.style.display = '';
            hasVisibleRows = true;
        } else {
            row.style.display = 'none';
        }
    });

    // Exibe a mensagem de "Nenhum item encontrado" se não houver linhas visíveis
    noResultsMessage.style.display = hasVisibleRows ? "none" : "block";
}

// Função para lidar com o clique na input de busca
const handleInputClick = () => {
    const select = document.getElementById("paginationControlNumberPageOptions");
    const option = document.getElementById('listAllBrands');

    if (option) {
        select.value = option.value;
        select.dispatchEvent(new Event("change"));
    }
}

// Inicializa o controle de paginação
const initializePagination = () => {
    paginationControl = document.getElementById("paginationControlNumberPageOptions");

    if (!paginationControl) return;

    paginationControl.removeEventListener("change", handlePaginationChange);
    paginationControl.addEventListener("change", handlePaginationChange);
}

// Função para lidar com a mudança de página
const handlePaginationChange = function () {
    const selectedOption = this.options[this.selectedIndex];
    const brandsUrl = selectedOption.getAttribute("data-brands-url");
    const page = 1;
    const numberOfLines = selectedOption.value;
    const filter = selectedOption.getAttribute("data-filter");
    const order = selectedOption.getAttribute("data-order");
    const currentOrder = selectedOption.getAttribute("data-current-order");

    listItem(brandsUrl, page, numberOfLines, filter, order, currentOrder);
}

// Inicializa a página
const initializePage = () => {
    let url;

    if (window.location.pathname === "/brands") {
        url = "http://localhost:8888/brands-list";
    } else {
        url = "";
    }

    if (url) {
        listItem(url, 1, 10, '', 1, -1);
    }
}

// Chama a função de inicialização
initializePage();
