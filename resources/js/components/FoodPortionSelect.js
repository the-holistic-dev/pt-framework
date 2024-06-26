import { util } from "../util";
class FoodPortionSelect {
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
        if (e.target.classList.contains("portion-select")) {
            const portionSelectName = e.target.name;
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
            const plan = JSON.parse(sessionStorage.getItem("nutritionplan"));
            const food = plan[`day${dayIndex}`][`meal${mealIndex}`][foodIndex];
            const [option] = e.target.selectedOptions;
            //food.cnf_food_measure_id = option.value;
            food.factor = parseFloat(option.dataset.factor);
            util.updateFoodInStorage(food, dayIndex, mealIndex, foodIndex);
        }
    }
}
export default FoodPortionSelect;
