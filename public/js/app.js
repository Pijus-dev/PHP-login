let pixel;

// fetch("/api.php")
//   .then((response) => response.json())
//   .then((data) => (pixel = data));

const btn = document.querySelector("#mygtukas");

btn.addEventListener("click", () => {
  const form = new FormData();
  form.append("x", "20");
  form.append("y", "60");
  form.append("color", "red");
  form.append("email", "pijuks@gmail.com");

  fetch("/create.php", {
    method: "POST",
    body: form,
  })
    .then((respsonse) => respsonse.text())
    .then((data) => console.log(data));
});
