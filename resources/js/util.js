class Util {
  constructor() {
    window.onbeforeunload = () => sessionStorage.clear();
    const pathString = window.location.pathname;
    let edit = false;
    if (pathString.includes("edit")) {
      edit = true;
    }
    this.initNutritionPlanForStorage(edit);
  }

  //Change html attrivute values with regex
  changeAttributeStringWithRegex(regex, elements, attrKey, newVal) {
    if (NodeList.prototype.isPrototypeOf(elements)) {
      elements.forEach((element) => {
        if (Array.isArray(attrKey) && attrKey.length > 1) {
          attrKey.forEach((key) => {
            let attribute = element.getAttribute(key);
            if (regex.test(attribute)) {
              attribute = attribute.replace(regex, newVal);
              element.setAttribute(key, attribute);
            }
          });
        } else {
          let attribute = element.getAttribute(attrKey);
          if (regex.test(attribute)) {
            attribute = attribute.replace(regex, newVal);
            element.setAttribute(attrKey, attribute);
          }
        }
      });
    } else {
      let attribute = elements.getAttribute(attrKey);
      if (regex.test(attribute)) {
        attribute = attribute.replace(regex, newVal);
        elements.setAttribute(attrKey, attribute);
      }
    }
  }

  getParentElement(element, parentSelector) {
    element = element.parentElement;
    while (
      !element.classList.contains(parentSelector) &&
      element.id != parentSelector &&
      element.tagName != parentSelector
    ) {
      element = element.parentElement;
    }
    return element;
  }

  nutritionPlanExistInStorage() {
    return sessionStorage.getItem("nutritionplan");
  }

  async initNutritionPlanForStorage(edit) {
    const plan = {};
    plan.day0 = { meal0: [], meal1: [], meal2: [] };
    plan.day1 = { meal0: [], meal1: [], meal2: [] };
    plan.day2 = { meal0: [], meal1: [], meal2: [] };
    if (edit) {
      const pathString = window.location.pathname;
      const regex = new RegExp("\\d+");
      const id = pathString.match(regex).pop();
      const reponse = await fetch(`/api/nutrition-plans/${id}`);
      const days = await reponse.json();
      days.forEach((day, dayIndex) => {
        day.forEach((meal, mealIndex) => {
          plan[`day${dayIndex}`][`meal${mealIndex}`] = meal;
        });
      });
    }
    sessionStorage.setItem("nutritionplan", JSON.stringify(plan));
  }

  addMealToPlanInStorage(dayIndex, mealIndex) {
    if (!util.nutritionPlanExistInStorage()) {
      util.initNutritionPlanForStorage();
    }
    const plan = JSON.parse(sessionStorage.getItem("nutritionplan"));
    const currentMeal = "meal" + mealIndex;
    plan[currentDay][currentMeal].push(food);
    sessionStorage.setItem("nutritionplan", JSON.stringify(plan));
  }

  addFoodToStorage(food, dayIndex, mealIndex, foodIndex) {
    if (!util.nutritionPlanExistInStorage()) {
      util.initNutritionPlanForStorage();
    }
    const plan = JSON.parse(sessionStorage.getItem("nutritionplan"));
    const currentDay = "day" + dayIndex;
    const currentMeal = "meal" + mealIndex;
    if (plan[currentDay][currentMeal][foodIndex]) {
      plan[currentDay][currentMeal][foodIndex] = food;
    } else {
      plan[currentDay][currentMeal].push(food);
    }
    sessionStorage.setItem("nutritionplan", JSON.stringify(plan));
    this.updateMealMacros(plan, dayIndex, mealIndex);
    this.updateDayMacros(dayIndex, plan[currentDay]);
  }

  updateFoodInStorage(food, dayIndex, mealIndex, foodIndex) {
    const plan = JSON.parse(sessionStorage.getItem("nutritionplan"));
    const currentDay = "day" + dayIndex;
    const currentMeal = "meal" + mealIndex;
    //console.log(plan);
    plan[currentDay][currentMeal][foodIndex] = food;
    console.log(plan);
    sessionStorage.setItem("nutritionplan", JSON.stringify(plan));
    this.updateMealMacros(plan, dayIndex, mealIndex);
    this.updateDayMacros(dayIndex, plan[currentDay]);
  }

  deleteFoodInStorage(dayIndex, mealIndex, foodIndex) {
    const plan = JSON.parse(sessionStorage.getItem("nutritionplan"));
    delete plan[`day${dayIndex}`][`meal${mealIndex}`][foodIndex];
    sessionStorage.setItem("nutritionplan", JSON.stringify(plan));
    this.updateMealMacros(plan, dayIndex, mealIndex);
    this.updateDayMacros(dayIndex, plan[currentDay]);
  }

  updateMealMacros(plan, dayIndex, mealIndex) {
    const macros = {
      protein: 0,
      fat: 0,
      carbohydrate: 0,
      fiber: 0,
      calorie: 0,
    };
    const currentDay = "day" + dayIndex;
    const currentMeal = "meal" + mealIndex;
    const foods = plan[currentDay][currentMeal];
    foods.forEach((food) => {
      const { quantity } = food;
      macros.protein += Math.round(food.factor * food.protein * quantity);
      macros.fat += Math.round(food.factor * food.fat * quantity);
      macros.carbohydrate += Math.round(
        food.factor * food.carbohydrate * quantity
      );
      macros.fiber += Math.round(food.factor * food.fiber * quantity);
      macros.calorie += Math.round(food.factor * food.calorie * quantity);
    });
    const element = document.querySelector(
      `input[name*='day[${dayIndex}][meal][${mealIndex}]']`
    );
    const accordionBody = util.getParentElement(element, "accordion-body");
    for (const [key, value] of Object.entries(macros)) {
      accordionBody.querySelector(`.meal-macro-row .${key}`).textContent =
        value;
    }
  }

  updateDayMacros(dayIndex, day) {
    const macros = {
      protein: 0,
      fat: 0,
      carbohydrate: 0,
      fiber: 0,
      calorie: 0,
    };
    for (const [mealKey, foods] of Object.entries(day)) {
      foods.forEach((food) => {
        const { quantity } = food;
        macros.protein += Math.round(food.factor * food.protein * quantity);
        macros.fat += Math.round(food.factor * food.fat * quantity);
        macros.carbohydrate += Math.round(
          food.factor * food.carbohydrate * quantity
        );
        macros.fiber += Math.round(food.factor * food.fiber * quantity);
        macros.calorie += Math.round(food.factor * food.calorie * quantity);
      });
    }
    const accordion = document.getElementById(`day${dayIndex}Accordion`);
    const macroRow = accordion.nextElementSibling.nextElementSibling;
    for (const [key, macro] of Object.entries(macros)) {
      macroRow.querySelector(`.${key}`).textContent = macro;
    }
  }

  getIndexForDay(name, key) {
    return name.split(`${key}[`).pop().split("]").shift();
  }
  getIndexForMealOrFood(name, key) {
    return name.split(`[${key}][`).pop().split("]").shift();
  }
}
export const util = new Util();
