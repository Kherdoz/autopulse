function onSubmitForm(event) {
  event.preventDefault();
  const url = form.action;
  const data = new FormData(form);
  data.append("operation", "deleteCar");
  const options = {
    method: "POST",
    body: data,
  };
  fetch(url, options)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      document.getElementById("car-" + data.id).remove();
    });
}
const form = document.getElementById("form-car");

form.addEventListener("submit", onSubmitForm);
