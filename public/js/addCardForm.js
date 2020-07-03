import { createDrinkForm } from "./createDrinkForm.js";
import { addForm } from "./addForm.js";

export const addCardForm = (parent) => {
  const addHandler = (e) => {
    e.preventDefault();
    addForm(e.target, parent);
  };

  createDrinkForm({}, addHandler, "Add");
};
