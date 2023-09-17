
function onClickCloseModalButton(event){
    const modal= event.currentTarget.closest(".modal-container");
    modal.classList.add("hidden");
}

const closeModalsButtons = document.querySelectorAll(".modal-container .close");
for(const closeModalButton of closeModalsButtons ){
    closeModalButton.addEventListener("click", onClickCloseModalButton)
}