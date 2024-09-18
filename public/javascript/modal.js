const insertionModalButton = document.querySelector("#insertionModalButton");
const insertionModal = document.querySelector("#insertionModal");
const modalOverflow = document.querySelector("#modalOverflow");
const closeInsertionModel = document.querySelector("#closeInsertionModel");

insertionModalButton.addEventListener("click", () => {
    insertionModal.style.display = "block";
    modalOverflow.style.display = "block";
});

closeInsertionModel.addEventListener("click", () => {
    insertionModal.style.display = "none";
    modalOverflow.style.display = "none";
});

modalOverflow.addEventListener("click", () => {
    insertionModal.style.display = "none";
    modalOverflow.style.display = "none";
});

function errorModal() {
    const insertionModal = document.querySelector("#insertionModal");
    const inputBrandName = document.querySelector("#name");

    insertionModal.classList.remove("animationModal");
    insertionModal.style.transform = "translate(-50%, -50%)";

    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector("#insertionModalButton").click();
    });

    setTimeout(() => {
        inputBrandName.classList.add("inputError");
    }, 150);
}