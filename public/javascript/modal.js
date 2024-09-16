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