import { util } from "../util";
class FoodTypeSelect {
    constructor() {
        this.accordions = document.querySelectorAll(".accordion");
        if (this.accordions.length > 0) {
            this.addEventListeners();
        }
    }

    addEventListeners() {
        this.accordions.forEach((accordion) => {
            accordion.addEventListener("change", this.change.bind(this));
        });
    }

    change(e) {
        if (e.target.classList.contains("food-type-select")) {
            const previous = e.target.parentElement.previousElementSibling;
            previous.querySelectorAll("input").forEach((input) => {
                input.classList.toggle("d-none");
                input.disabled = !input.disabled;
            });
            previous
                .querySelectorAll("label")
                .forEach((label) => label.classList.toggle("d-none"));
            const foodRow = util.getParentElement(e.target, "food-row");
            const portionSelect = foodRow.querySelector(".portion-select");
            portionSelect.disabled = !portionSelect.disabled;
            foodRow.querySelectorAll(".quantity").forEach((input) => {
                input.classList.toggle("d-none");
                input.disabled = !input.disabled;
            });
        }
    }
}
export default FoodTypeSelect;
