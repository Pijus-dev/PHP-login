import { createCard } from "./createCard.js";

export const editDrink = (form_element, parent) => {
  const form = new FormData(form_element);
  fetch("/api/edit.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      form_element.remove();
      const card = createCard(data);
      parent.replaceWith(card);
    });
};
