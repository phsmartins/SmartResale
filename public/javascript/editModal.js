const editModal = document.querySelector("#editModal");
const closeEditModel = document.querySelector("#closeEditModel");

const editModalOverflow = document.querySelector("#editModalOverflow");

window.scrollTo({top: 0,});
document.body.style.overflow = "hidden";

editModalOverflow.addEventListener("click", () => {
    editModalOverflow.style.display = "none";
    editModal.style.display = "none";

    document.body.style.overflow = "auto";
});

closeEditModel.addEventListener("click", () => {
    editModal.style.display = "none";
    editModalOverflow.style.display = "none";

    document.body.style.overflow = "auto";
});