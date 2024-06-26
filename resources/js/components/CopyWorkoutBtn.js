import { util } from "../util";
class CopyWorkoutBtn {
    constructor() {
        this.btns = document.querySelectorAll(".copy-workout");
        this.addEventListeners();
    }

    addEventListeners() {
        this.btns.forEach((btn) => {
            btn.addEventListener("click", this.copyWorkout.bind(this));
        });
    }

    copyWorkout(e) {
        const toSelect =
            e.target.parentElement.parentElement.querySelector(
                ".copy-workout-to"
            );
        const accordion = util
            .getParentElement(e.target, "col-6")
            .querySelector(".accordion");
        const copyToAccordion = document.getElementById(
            `workoutAccordion${toSelect.value}`
        );
        const accordionItems = accordion.querySelectorAll(".accordion-item");
        copyToAccordion.innerHTML = "";

        accordionItems.forEach((item) => {
            const clone = item.cloneNode(true);
            this.changeCollapseAttribute(clone, toSelect.value);
            this.changeInputName(clone, toSelect.value);
            copyToAccordion.append(clone);
        });
    }

    changeCollapseAttribute(clone, index) {
        const accordionRegex = new RegExp("(Workout)[0-9]");
        const workoutIndex = `Workout${index}`;
        util.changeAttributeStringWithRegex(
            accordionRegex,
            clone.querySelector(".accordion-header .accordion-button"),
            "data-bs-target",
            workoutIndex
        );
        util.changeAttributeStringWithRegex(
            accordionRegex,
            clone.querySelector(".accordion-header .accordion-button"),
            "aria-controls",
            workoutIndex
        );
        util.changeAttributeStringWithRegex(
            accordionRegex,
            clone.querySelector(".accordion-collapse"),
            "id",
            workoutIndex
        );
    }

    changeInputName(clone, index) {
        const workoutNameAttrRegex = new RegExp("(workout\\[)[0-9]\\]");
        const workoutIndex = `workout[${index}]`;
        util.changeAttributeStringWithRegex(
            workoutNameAttrRegex,
            clone.querySelectorAll("input"),
            "name",
            workoutIndex
        );
    }
}
export default CopyWorkoutBtn;
