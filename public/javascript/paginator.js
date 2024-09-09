const tbody = document.querySelector(".list_items_js");
const table = document.querySelector("table");
const noItemsFound = document.querySelector("#noItemsFound");

const listItem = async (url, page) => {
    const response = await fetch(`${url}?page=${page}`);
    tbody.innerHTML = await response.text();
}

if (window.location.pathname === "/brands") {
    url = "http://localhost:8888/brands-list";
} else {
    url = "";
}

if (url === "" || !url) {
    table.style.display = "none";
    noItemsFound.textContent = "Erro ao buscar itens. Se o erro persistir, entre em contato com o suporte";
} else {
    listItem(url, 1);
}
