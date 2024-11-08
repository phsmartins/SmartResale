const tbody = document.querySelector(".list_items_js");

const listItem = async (url, page, limit, filter, order, currentOrder) => {
    const response = await fetch(`${url}?page=${page}&limit=${limit}&filter=${filter}&order=${order}&current_order=${currentOrder}`);
    tbody.innerHTML = await response.text();
    console.log(tbody.innerHTML);

    const inputSearchBrand = document.querySelector('#inputSearchBrand');

    inputSearchBrand.addEventListener("click", () => {
        const select = document.getElementById("paginationControlNumberPageOptions");
        const option = document.getElementById('listAllBrands');

        if (option) {
            select.value = option.value;
            select.dispatchEvent(new Event("change"));
        }
    });

    document.getElementById("paginationControlNumberPageOptions").addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];

        const brandsUrl = selectedOption.getAttribute("data-brands-url");
        const page = 1;
        const numberOfLines = selectedOption.value;
        const filter = selectedOption.getAttribute("data-filter");
        const order = selectedOption.getAttribute("data-order");
        const currentOrder = selectedOption.getAttribute("data-current-order");

        listItem(brandsUrl, page, numberOfLines, filter, order, currentOrder);
    });
}

if (window.location.pathname === "/brands") {
    url = "http://localhost:8888/brands-list";
} else {
    url = "";
}

if (!(url === "" || !url)) {
    listItem(url, 1, 10, '', 1, -1);
}

