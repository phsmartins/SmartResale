const tbody = document.querySelector(".list_items_js");

const listItem = async (url, page, limit) => {
    const response = await fetch(`${url}?page=${page}&limit=${limit}`);
    tbody.innerHTML = await response.text();

    document.getElementById('pagination_options').addEventListener('click', () => {
        setTimeout(() => {
            scrollToBottom();
        }, 100);
    });

    const scrollToBottom = () => {
        document.documentElement.scrollTop = document.documentElement.scrollHeight;
        document.body.scrollTop = document.body.scrollHeight; // Para compatibilidade com alguns navegadores
    };

    // Evento de clique no botão


}

if (window.location.pathname === "/brands") {
    url = "http://localhost:8888/brands-list";
} else {
    url = "";
}

if (!(url === "" || !url)) {
    listItem(url, 1, 10);
}
