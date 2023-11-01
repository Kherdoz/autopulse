function onSubmitForm(event) {
  if (event.submitter.name === "deleteCar") {
    event.preventDefault();
    const url = form.action;
    const data = new FormData(form);
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
      console.log(form.carId);
      fetch(url, options)
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          console.log(data.id);
          document.getElementById("car-" + data.id).remove();
        });
    }
  }
}
const form = document.getElementById("form-car");
form.addEventListener("submit", onSubmitForm);
