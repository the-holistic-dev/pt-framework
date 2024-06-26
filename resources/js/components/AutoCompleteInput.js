import autoComplete from "@tarekraafat/autocomplete.js";
import { util } from "../util";
class AutoCompleteInput {
  constructor() {
    this.autoCompleteInputs = document.querySelectorAll(".auto-complete");
    if (this.autoCompleteInputs) {
      this.init();
      this.addEventListener();
    }
  }

  init() {
    this.autoCompleteInputs.forEach((input) => {
      const autoCompleteJS = new autoComplete({
        selector: () => input,
        placeholder: "Enter a food name...",
        data: {
          src: async (name) => {
            const res = await fetch(`/api/cnf-food/${name}`);
            const data = await res.json();
            return data;
          },
        },
        debounce: 500,
        searchEngine: (query, record) => {
          if (
            query
              .split(" ")
              .every((item) => record.name.toLowerCase().includes(item))
          ) {
            return record.name;
          }
        },
        resultsList: {
          class: "overflow-y list-group",
          element: (list, data) => {
            /* console.log(list);
            console.log(data); */
            const info = document.createElement("p");
            if (data.results.length > 0) {
              info.innerHTML = `Displaying <strong>${data.results.length}</strong> out of <strong>${data.matches.length}</strong> results`;
            } else {
              info.innerHTML = `Found <strong>${data.matches.length}</strong> matching results for <strong>"${data.query}"</strong>`;
            }
            list.prepend(info);
          },
          noResults: true,
          maxResults: 10,
          tabSelect: true,
        },
        resultItem: {
          element: (item, data) => {
            // Modify Results Item Style
            item.classList.add(
              "list-group-item",
              "list-group-item-action",
              "list-group-item-primary",
              "pe-auto"
            );
            // Modify Results Item Content
            item.innerHTML = `
            <span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
              ${data.match}
            </span>
            `;
          },
          highlight: true,
        },
      });
    });
  }

  addEventListener() {
    this.autoCompleteInputs.forEach((input) => {
      input.addEventListener("selection", this.selection);
    });
  }

  selection(e) {
    console.log(e.detail);
    const food = e.detail.selection.value;
    e.target.value = food.name;
    console.log(food);
    const portionSelect = util
      .getParentElement(e.target, "food-row")
      .querySelector(".portion-select");
    portionSelect.innerHTML = "";
    food.factors.forEach((measure) => {
      const optionElement = document.createElement("option");
      optionElement.value = measure.id;
      optionElement.dataset.factor = measure.factor;
      optionElement.text = measure.name;
      portionSelect.options.add(optionElement);
    });
    const { factor, cnf_food_measure_id } = food.factors[0];
    food.cnf_food_measure_id = cnf_food_measure_id;
    food.factor = factor;
    food.quantity = 1;
    const portionSelectName = portionSelect.name;
    const dayIndex = portionSelectName.split("day[").pop().split("]").shift();
    const mealIndex = portionSelectName
      .split("[meal][")
      .pop()
      .split("]")
      .shift();
    const foodIndex = portionSelectName
      .split("[food][")
      .pop()
      .split("]")
      .shift();
    util.addFoodToStorage(food, dayIndex, mealIndex, foodIndex);
  }
}
export default AutoCompleteInput;
