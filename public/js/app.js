import { createNode } from "./createNode.js";
import { createCard } from "./createCard.js";
import { addCardForm } from "./addCardForm.js";

const app = document.querySelector(".app");

const createProductContainer = (data) => {
  const container = createNode("div", { class: "wrapper" });
  const addButton = createNode("button", {
    class: "add",
    click: () => addCardForm(container),
  });
  
  addButton.innerHTML = "&#10010";
  app.append(container);
  app.append(addButton);

  data.forEach((drink) => {
    container.append(createCard(drink));
  });
};

fetch("/api/get.php")
  .then((response) => response.json())
  .then((data) => createProductContainer(data));
