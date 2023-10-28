function onSubmitForm(event) {
  event.preventDefault();
  const url = form.action;
  const data = new FormData(form);

  if (event.submitter.name === "deleteCar") {
    // Demander la confirmation
    const confirmation = window.confirm(
      "Voulez-vous vraiment supprimer cette annonce ?"
    );
    if (confirmation) {
      data.set("operation", "deleteCar");
      const options = {
        method: "POST",
        body: data,
      };
      fetch(url, options)
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          if (data.operation === "deleteCar") {
            document.getElementById("car-" + data.id).remove();
          }
        });
    }
  } else if (event.submitter.name === "editCar") {
    // Rediriger vers la page de modification
    const carId = event.submitter.value;
    window.location.href = "editCar?id=" + carId; // Remplacez "modifier.php" par l'URL de votre page de modification
  }
}

const form = document.getElementById("form-car");
form.addEventListener("submit", onSubmitForm);
