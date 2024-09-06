const tbody = document.querySelector("tbody");
const table = document.querySelector("table");
const noItemsFound = document.querySelector("#noItemsFound");

const listItem = async (url) => {
    const response = await fetch(url);
    const data = await response.text();

    if (!data || data.trim() === "") {
        table.style.display = "none";
        noItemsFound.textContent = "Whoops... Nenhum registro encontrado";
    } else {
        tbody.innerHTML = data;
    }
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
    listItem(url)
}
