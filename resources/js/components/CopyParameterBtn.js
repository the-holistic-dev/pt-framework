import { util } from "../util";
class CopyParameterBtn {
    constructor() {
        this.copySingleBtns = document.querySelectorAll(
            ".copy-single-parameter"
        );
        this.copyAllBtns = document.querySelectorAll(".copy-all-parameter");
        this.addEventListeners();
    }

    addEventListeners() {
        this.copySingleBtns.forEach((btn) => {
            btn.addEventListener("click", this.copyToSingleExercise);
        });
        this.copyAllBtns.forEach((btn) => {
            btn.addEventListener("click", this.copyToAllExercise);
        });
    }

    copyToSingleExercise(e) {
        const currentAccordionBody = e.target.parentElement.parentElement;
        const currentInputs = currentAccordionBody.querySelectorAll("input");
        const nextExerciseAccordionItem = util.getParentElement(
            currentAccordionBody,
            "accordion-item"
        ).nextElementSibling;
        const nextExerciseInputs =
            nextExerciseAccordionItem.querySelectorAll("input");
        nextExerciseInputs.forEach((input, index) => {
            if (!input.name.includes("order")) {
                input.value = currentInputs[index].value;
            }
        });
        const exerciseOrderInput = exerciseAccordionItem.querySelector(
            "input[name*='order']"
        );
        const exerciseNameInput =
            nextExerciseAccordionItem.querySelector(".exercise-name");
        nextExerciseAccordionItem.querySelector(
            ".accordion-header .accordion-button"
        ).innerText = `${exerciseOrderInput.value} ${exerciseNameInput.value}`;
    }

    copyToAllExercise(e) {
        const currentAccordionBody = e.target.parentElement.parentElement;
        const currentInputs = currentAccordionBody.querySelectorAll("input");
        let exerciseAccordionItem = util.getParentElement(
            currentAccordionBody,
            "accordion-item"
        );
        while (exerciseAccordionItem.nextElementSibling) {
            exerciseAccordionItem = exerciseAccordionItem.nextElementSibling;
            const nextExerciseInputs =
                exerciseAccordionItem.querySelectorAll("input");
            nextExerciseInputs.forEach((input, index) => {
                if (!input.name.includes("order")) {
                    input.value = currentInputs[index].value;
                }
            });
            const exerciseOrderInput = exerciseAccordionItem.querySelector(
                "input[name*='order']"
            );
            const exerciseNameInput =
                exerciseAccordionItem.querySelector(".exercise-name");
            exerciseAccordionItem.querySelector(
                ".accordion-header .accordion-button"
            ).innerText = `${exerciseOrderInput.value} ${exerciseNameInput.value}`;
        }
    }
}
export default CopyParameterBtn;
