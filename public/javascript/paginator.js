const tbody = document.querySelector(".list_items_js");

const listItem = async (url, page, limit, filter) => {
    const response = await fetch(`${url}?page=${page}&limit=${limit}&filter=${filter}`);
    tbody.innerHTML = await response.text();
}

if (window.location.pathname === "/brands") {
    url = "http://localhost:8888/brands-list";
} else {
    url = "";
}

if (!(url === "" || !url)) {
    listItem(url, 1, 10, 'id');
}
