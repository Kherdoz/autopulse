function onClickCloseModalButton(event) {
  const modal = event.currentTarget.closest(".modal-container");
  modal.classList.add("hidden");
}

const closeModalsButtons = document.querySelectorAll(".modal-container .close");
for (const closeModalButton of closeModalsButtons) {
  closeModalButton.addEventListener("click", onClickCloseModalButton);
}


function afficherPhoto() {
  const input = document.getElementById("originalFileName");
  const imageCarousel = document.getElementById("image-carousel");

  // Vérifier s'il y a des fichiers sélectionnés
  if (input.files && input.files.length > 0) {
    // Limiter à 4 photos
    if (imageCarousel.children.length >= 4) {
      alert("Vous ne pouvez télécharger que 4 photos maximum.");
      return;
    }

    for (let i = 0; i < input.files.length; i++) {
      const file = input.files[i];
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
      });
      imageContainer.appendChild(removeButton);

      imageCarousel.appendChild(imageContainer);
    }

    // Effacer le champ d'entrée après avoir ajouté les images
    input.value = "";
  }
}
