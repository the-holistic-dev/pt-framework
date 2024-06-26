import { util } from "../util";
class FoodQuantityInput {
  constructor() {
    this.accordions = document.querySelectorAll(".accordion");
    if (this.accordions.length > 0) {
      this.addEventListeners();
    }
    this.timerId = null;
  }

  addEventListeners() {
    this.accordions.forEach((accordion) => {
      accordion.addEventListener("keypress", this.keypress.bind(this));
    });
  }

  keypress(e) {
    if (e.target.classList.contains("quantity")) {
      setTimeout(() => {
        const newQuantity = eval(e.target.value);
        console.log(newQuantity);
        if (typeof newQuantity === "number" && newQuantity > 0) {
          const quantityInputName = e.target.name;
          const foodType =
            e.target.parentElement.parentElement.querySelector(
              ".food-type-select"
            ).value;
          const dayIndex = quantityInputName
            .split("day[")
            .pop()
            .split("]")
            .shift();
          const mealIndex = quantityInputName
            .split("[meal][")
            .pop()
            .split("]")
            .shift();
          const foodIndex = quantityInputName
            .split(`[${foodType}][`)
            .pop()
            .split("]")
            .shift();
          const plan = JSON.parse(sessionStorage.getItem("nutritionplan"));
          const food = plan[`day${dayIndex}`][`meal${mealIndex}`][foodIndex];
          food.quantity = newQuantity;
          console.log(food);
          util.updateFoodInStorage(food, dayIndex, mealIndex, foodIndex);
        }
      }, 500);
    }
  }
}
export default FoodQuantityInput;
