import { util } from "../util";

class AddExerciseBtn {
    constructor() {
        this.btns = document.querySelectorAll(".add-exercise");
        this.addEventListeners();
    }

    addEventListeners() {
        this.btns.forEach((btn) => {
            btn.addEventListener("click", this.addExercise.bind(this));
        });
    }

    addExercise(e) {
        const exerciseAccordion = e.target.parentElement.previousElementSibling;
        const exerciseNodes =
            exerciseAccordion.querySelectorAll(".accordion-item");
        const lastNode = exerciseNodes[exerciseNodes.length - 1];
        const clone = lastNode.cloneNode(true);
        this.changeCollapseAttribute(exerciseNodes, clone);
        this.changeInputName(exerciseNodes, clone);
        this.incrementExerciseOrder(clone);
        exerciseAccordion.append(clone);
    }

    changeCollapseAttribute(exerciseNodes, clone) {
        const accordionRegex = new RegExp("(Exercise)[0-9]+");
        const newExerciseAccordion = `Exercise${exerciseNodes.length}`;
        util.changeAttributeStringWithRegex(
            accordionRegex,
            clone.querySelector(".accordion-header .accordion-button"),
            "data-bs-target",
            newExerciseAccordion
        );
        util.changeAttributeStringWithRegex(
            accordionRegex,
            clone.querySelector(".accordion-header .accordion-button"),
            "aria-controls",
            newExerciseAccordion
        );
        util.changeAttributeStringWithRegex(
            accordionRegex,
            clone.querySelector(".accordion-collapse"),
            "id",
            newExerciseAccordion
        );
    }

    changeInputName(exerciseNodes, clone) {
        const newExerciseIndex = `[parameter][${exerciseNodes.length}]`;
        const exerciseNameAttrRegex = new RegExp(
            "(\\[parameter\\]\\[)[0-9]+\\]"
        );
        util.changeAttributeStringWithRegex(
            exerciseNameAttrRegex,
            clone.querySelectorAll("input"),
            "name",
            newExerciseIndex
        );
    }

    incrementExerciseOrder(clone) {
        const orderInput = clone.querySelector("input[name*='order']");
        const orderVal = orderInput.value;
        let orderLetter = orderVal.match("[a-zA-Z]");
        let orderNumber = parseInt(orderVal.match("\\d+"));
        if (orderNumber) {
            //if no number we keep the character and increment the number
            ++orderNumber;
            orderInput.value = `${orderLetter}${orderNumber}`;
            clone.querySelector(
                ".accordion-header .accordion-button"
            ).innerText = `${orderLetter}${orderNumber}`;
        } else {
            //if no number we change the character
            const nextLetter = String.fromCharCode(
                orderLetter[0].charCodeAt(orderLetter[0]) + 1
            );
            orderInput.value = `${nextLetter}`;
            clone.querySelector(
                ".accordion-header .accordion-button"
            ).innerText = `${nextLetter}`;
        }
    }
}
export default AddExerciseBtn;
