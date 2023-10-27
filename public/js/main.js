// permet de fermer les modale
function onClickCloseModalButton(event) {
  const modal = event.currentTarget.closest(".modal-container");
  modal.classList.add("hidden");
}

// permet que le flashmessage reste que 4 seconde
function hideFlashMessage(delay){
  const flashMessage = document.querySelector('.flash-message');

  if (flashMessage) {
    // Attendez 4 secondes (4000 millisecondes) avant de masquer le message flash
    setTimeout(function () {
      flashMessage.style.display = 'none';
    }, delay);
  }
}

// affiche les photo
function afficherPhoto() {
  const input = document.getElementById("originalFileName");
  const imageCarousel = document.getElementById("image-carousel");

  // Effacer toutes les images existantes
  imageCarousel.innerHTML = "";

  if (input.files && input.files.length > 0) {
    // Assurez-vous que vous n'ajoutez qu'une seule photo
    if (input.files.length > 1) {
      alert("Vous ne pouvez télécharger qu'une seule photo.");
      input.value = ""; // Efface le champ d'entrée
      return;
    }

    const file = input.files[0];
    const imageContainer = document.createElement("div");
    imageContainer.classList.add("image-container");
    const image = document.createElement("img");
    image.src = URL.createObjectURL(file);
    image.style.borderRadius = "10px"; // Appliquer un border-radius de 10px
    imageContainer.appendChild(image);

    // Bouton pour retirer l'image
    const removeButton = document.createElement("button");
    removeButton.textContent = "Retirer";
    removeButton.classList.add("remove-button");
    removeButton.addEventListener("click", () => {
      imageContainer.remove();
      input.value = ""; // Effacer le champ d'entrée
    });
    imageContainer.appendChild(removeButton);

    imageCarousel.appendChild(imageContainer);
  }
}


// code principal
const closeModalsButtons = document.querySelectorAll(".modal-container .close");
for (const closeModalButton of closeModalsButtons) {
  closeModalButton.addEventListener("click", onClickCloseModalButton);
}
 hideFlashMessage(4000);