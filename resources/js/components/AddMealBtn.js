import { util } from "../util";

class AddMealBtn {
    constructor() {
        this.btns = document.querySelectorAll(".add-meal");
        this.addEventListeners();
    }

    addEventListeners() {
        this.btns.forEach((btn) => {
            btn.addEventListener("click", this.click.bind(this));
        });
    }

    click(e) {
        const dayAccordion = e.target.parentElement.previousElementSibling;
        const mealAccordionItems =
            dayAccordion.querySelectorAll(".accordion-item");
        const lastNode = mealAccordionItems[mealAccordionItems.length - 1];
        const clone = lastNode.cloneNode(true);
        this.changeInputName(mealAccordionItems, clone);
        mealAccordionItems[mealAccordionItems.length - 1].after(clone);
    }

    changeInputName(mealItems, clone) {
        const accordionAttrRegex = new RegExp("(Day)[0-9]+");
        const newMealIndex = `[meal][${mealItems.length}]`;
        util.changeAttributeStringWithRegex(
            accordionAttrRegex,
            clone.querySelector(".accordion-header .accordion-button"),
            "data-bs-target",
            newMealIndex
        );
        util.changeAttributeStringWithRegex(
            accordionAttrRegex,
            clone.querySelector(".accordion-header .accordion-button"),
            "aria-controls",
            newMealIndex
        );
        util.changeAttributeStringWithRegex(
            accordionAttrRegex,
            clone.querySelector(".accordion-collapse"),
            "id",
            newMealIndex
        );
        const mealNameAttrRegex = new RegExp("(\\[meal\\]\\[)[0-9]+\\]");
        util.changeAttributeStringWithRegex(
            mealNameAttrRegex,
            clone.querySelectorAll('input[name*="group"]'),
            "name",
            newMealIndex
        );
        util.changeAttributeStringWithRegex(
            mealNameAttrRegex,
            clone.querySelectorAll('input[name*="food"]'),
            "name",
            newMealIndex
        );
        util.changeAttributeStringWithRegex(
            mealNameAttrRegex,
            clone.querySelectorAll("select"),
            "name",
            newMealIndex
        );
    }
}
export default AddMealBtn;
