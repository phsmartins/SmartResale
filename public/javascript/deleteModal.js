const deleteModal = document.querySelector("#deleteModal");
const closeDeleteModel = document.querySelector("#closeDeleteModel");

const deleteModalOverflow = document.querySelector("#deleteModalOverflow");

window.scrollTo({top: 0,});
document.body.style.overflow = "hidden";

deleteModalOverflow.addEventListener("click", () => {
    deleteModalOverflow.style.display = "none";
    deleteModal.style.display = "none";

    document.body.style.overflow = "auto";
});

closeDeleteModel.addEventListener("click", () => {
    deleteModal.style.display = "none";
    deleteModalOverflow.style.display = "none";

    document.body.style.overflow = "auto";
});