import { createCard } from "./createCard.js";

export const addForm = (form_element, parent) => {
  const form = new FormData(form_element);

  fetch("/api/add.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      parent.append(createCard(data))
    });
};
