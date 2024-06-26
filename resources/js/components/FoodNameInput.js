import { util } from "../util";
class FoodNameInput {
    constructor() {
        this.foodList = document.getElementById("foodList");
        if (this.foodList) {
            this.accordions = document.querySelectorAll(".accordion");
            this.foodDataListOptions = Array.from(
                this.foodList.querySelectorAll("option")
            );
            this.addEventListeners();
            this.eventSource = null;
            this.timerId = null;
        }
    }

    addEventListeners() {
        this.accordions.forEach((accordion) => {
            accordion.addEventListener("keydown", this.keydown.bind(this));
            accordion.addEventListener("input", this.input.bind(this));
        });
    }

    keydown(e) {
        if (e.target.classList.contains("food-name")) {
            this.eventSource = e.key ? "input" : "list";
            if (e.keyCode == 13) {
                this.timerId = null;
            }

            if (
                this.eventSource === "input" &&
                e.keyCode != 8 &&
                e.target.value.length > 2
            ) {
                const val = e.target.value.toLowerCase();
                const regex = new RegExp(`${val}`);
                let found = {};
                const portionSelect = util
                    .getParentElement(e.target, "food-row")
                    .querySelector(".portion-select");
                portionSelect.innerHTML = "";
                if (typeof this.timerId === "number") {
                    clearTimeout(this.timerId);
                }
                const element = this.foodDataListOptions.find((option) =>
                    regex.test(option.value.toLowerCase())
                );
                found.id = element.dataset.value;
                found.name = element.value;
                this.timerId = setTimeout(() => {
                    if (found.id) {
                        e.target.value = found.name;
                        e.target.nextElementSibling.value = found.id;
                        this.setSelectOptions(found.id, portionSelect);
                    }
                }, 2000);
            }
        }
    }

    input(e) {
        if (e.target.classList.contains("food-name")) {
            const val = e.target.value;
            const portionSelect = util
                .getParentElement(e.target, "food-row")
                .querySelector(".portion-select");
            portionSelect.innerHTML = "";
            if (this.eventSource === "list") {
                let foodId = null;
                this.foodDataListOptions.filter((option) => {
                    if (option.value == val) {
                        foodId = option.dataset.value;
                        e.target.nextElementSibling.value = foodId;
                    }
                });
                this.setSelectOptions(foodId, portionSelect);
            }
        }
    }

    async setSelectOptions(foodId, portionSelect) {
        if (foodId) {
            const reponse = await fetch(`/api/cnf-measures/${foodId}`);
            const food = await reponse.json();
            food.factors.forEach((measure) => {
                const optionElement = document.createElement("option");
                optionElement.value = measure.id;
                optionElement.dataset.factor = measure.factor;
                optionElement.text = measure.name;
                portionSelect.options.add(optionElement);
            });
            const { factor, cnf_food_measure_id } = food.factors[0];
            food.id = foodId;
            food.cnf_food_measure_id = cnf_food_measure_id;
            food.factor = factor;
            food.quantity = 1;
            const portionSelectName = portionSelect.name;
            const dayIndex = portionSelectName
                .split("day[")
                .pop()
                .split("]")
                .shift();
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
}
export default FoodNameInput;
