import { util } from "../util";

class AddFoodBtn {
    constructor() {
        this.btns = document.querySelectorAll(".add-food");
        this.addEventListeners();
    }

    addEventListeners() {
        this.btns.forEach((btn) => {
            btn.addEventListener("click", this.addFood.bind(this));
        });
    }

    addFood(e) {
        const mealAccordionBody = e.target.parentElement.parentElement;
        const foodNodes = mealAccordionBody.querySelectorAll(".food-row");
        const lastNode = foodNodes[foodNodes.length - 1];
        const clone = lastNode.cloneNode(true);
        this.changeInputName(foodNodes, clone);
        foodNodes[foodNodes.length - 1].after(clone);
    }

    changeInputName(foodNodes, clone) {
        const newGroupIndex = `[group][${foodNodes.length}]`;
        const groupNameAttrRegex = new RegExp("(\\[group\\]\\[)[0-9]+\\]");
        util.changeAttributeStringWithRegex(
            groupNameAttrRegex,
            clone.querySelectorAll('input[name*="group"]'),
            "name",
            newGroupIndex
        );
        const newFoodIndex = `[food][${foodNodes.length}]`;
        const foodNameAttrRegex = new RegExp("(\\[food\\]\\[)[0-9]+\\]");
        util.changeAttributeStringWithRegex(
            foodNameAttrRegex,
            clone.querySelectorAll('input[name*="food"]'),
            "name",
            newFoodIndex
        );
        util.changeAttributeStringWithRegex(
            foodNameAttrRegex,
            clone.querySelectorAll("select"),
            "name",
            newFoodIndex
        );
    }
}
export default AddFoodBtn;
