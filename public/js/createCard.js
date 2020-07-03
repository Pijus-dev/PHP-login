import { createNode } from "./createNode.js";
import { deleteDrink } from "./deleteDrink.js";
import { createEditForm } from "./createEditForm.js";
// import { addCardForm} from "./addCardForm.js";

export const createCard = (value) => {
  const card = createNode('div', {class: 'card'});

  const cardBody = createNode('div', {class: 'card-border'});

  const p = createNode("p", {}, `price: ${value.price} €`);

  const cardImg = createNode("img", { class: "card-img", src: value.photo });

  const cardInfo = createNode('div', {class: 'card-info'});

  const name = createNode("h2", {}, value.name);

  const percentage = createNode("h2", {}, `${value.percentage}%`);

  const size = createNode("h2", {}, `Size: ${value.size}ml`);

  const edit = createNode(
    "button",
    { class: "add-item", click: () => createEditForm(value, card) },
    "edit"
  );

  const remove = createNode(
    "button",
    { class: "delete-button", click: () => deleteDrink(value.id, card) },
    "remove"
  );

  cardInfo.append(name, percentage, size);

  const amount = createNode("p", {}, `Available: ${value.amount}`);

  cardBody.append(p, cardImg, cardInfo, edit, remove);
  card.append(cardBody, amount);

  return card;
};
