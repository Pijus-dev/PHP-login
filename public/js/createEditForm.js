import { editDrink } from "./editDrink.js";
import { createDrinkForm } from "./createDrinkForm.js";

export const createEditForm = (value, card) => {
  const editHandler = (e) => {
    e.preventDefault();
    editDrink(e.target, card);
  };

  createDrinkForm(value, editHandler, "edit");
};
