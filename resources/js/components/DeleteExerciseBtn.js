class DeleteExerciseBtn {
    constructor() {
        this.btns = document.querySelectorAll(".delete-exercise");
        this.addEventListeners();
    }

    addEventListeners() {
        this.btns.forEach((btn) => {
            btn.addEventListener("click", this.deleteExercise);
        });
    }

    deleteExercise(e) {
        const exerciseAccordion = e.target.parentElement.previousElementSibling;
        const exerciseNodes =
            exerciseAccordion.querySelectorAll(".accordion-item");
        if (exerciseNodes.length > 1) {
            const lastNode = exerciseNodes[exerciseNodes.length - 1];
            lastNode.remove();
        } else {
            const accordionItem =
                exerciseAccordion.querySelector(".accordion-item");
            const inputs = accordionItem.querySelectorAll(
                ".accordion-body input"
            );
            inputs.forEach((input) => {
                input.value = "";
            });
            exerciseAccordion.querySelector(
                ".accordion-header .accordion-button"
            ).innerText = "A1";
        }
    }
}
export default DeleteExerciseBtn;
