import { util } from "../util";
class OrderInput {
    constructor() {
        this.inputs = document.querySelectorAll("input[name*='order']");
        this.addEventListeners();
    }

    addEventListeners() {
        this.inputs.forEach((btn) => {
            btn.addEventListener("keydown", this.copyOrder);
        });
    }

    copyOrder(e) {
        const accordionItem = util.getParentElement(e.target, "accordion-item");
        const accordionButton = accordionItem.querySelector(
            ".accordion-header .accordion-button"
        );
        const exerciseNameInput = accordionItem.querySelector(".exercise-name");
        setTimeout(() => {
            if (exerciseNameInput.value.length > 0) {
                accordionButton.innerText = `${e.target.value} ${exerciseNameInput.value}`;
            } else {
                accordionButton.innerText = e.target.value;
            }
        }, 500);
    }
}
export default OrderInput;
