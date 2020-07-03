export const deleteDrink = (id, parent) => {
  const form = new FormData();
  form.append("id", id);

  fetch("/api/delete.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data) {
        parent.remove();
      }
    });
};
