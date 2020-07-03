import { createNode } from "./createNode.js";

export const createDrinkForm = (data, handler, buttonName) => {
    const main = document.querySelector(".app");

    const form = createNode("form", {
      class: "edit-form",
      submit: handler
    });
  
    const priceInput = createNode("input", { name: "price", value: data.price ?? '' });
    const nameInput = createNode("input", { name: "name", value: data.name  ?? ''});
    const percentage = createNode("input", {
      name: "percentage",
      value: data.percentage ?? '',
    });
  
    const size = createNode("input", { name: "size", value: data.size  ?? '' });
    const photo = createNode("input", { name: "photo", value: data.photo ?? '' });
    const amount = createNode("input", { name: "amount", value: data.amount ?? '' });
    const id = createNode("input", {
      name: "id",
      type: "hidden",
      value: data.id ?? '' });
  
    const button = createNode(
      "button",
      { name: "button", type: "submit", class: "btn" },
      buttonName
    );
  
    form.append(
      priceInput,
      nameInput,
      percentage,
      size,
      photo,
      id,
      amount,
      button
    );
  
    main.prepend(form);
   
    return form;
}