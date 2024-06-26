import { util } from "../util";
class ExerciseInput {
    constructor() {
        const exerciseList = document.getElementById("exerciseList");
        if (exerciseList) {
            this.accordions = document.querySelectorAll(".accordion");
            this.exerciseDataListOptions = Array.from(
                exerciseList.querySelectorAll("option")
            );
            this.addEventListeners();
            this.eventSource = null;
            this.timerId = null;
        }
    }

    addEventListeners() {
        this.accordions.forEach((accordion) => {
            accordion.addEventListener("keydown", this.keydown.bind(this));
            accordion.addEventListener("input", this.input.bind(this));
        });
    }

    keydown(e) {
        if (e.target.classList.contains("exercise-name")) {
            this.eventSource = e.key ? "input" : "list";
            if (e.key == 13) {
                this.timerId = null;
            }
            const accordionItem = util.getParentElement(
                e.target,
                "accordion-item"
            );
            const exerciseOrder = accordionItem.querySelector(
                "input[name*='order']"
            ).value;
            if (
                this.eventSource === "input" &&
                e.keyCode != 8 &&
                e.target.value.length > 2
            ) {
                const val = e.target.value.toLowerCase();
                const regex = new RegExp(`${val}`);
                let found = {};
                if (typeof this.timerId === "number") {
                    clearTimeout(this.timerId);
                }
                const element = this.exerciseDataListOptions.find((option) =>
                    regex.test(option.value.toLowerCase())
                );

                found.id = element.dataset.value;
                found.name = element.value;
                this.timerId = setTimeout(() => {
                    if (found.id) {
                        e.target.value = found.name;
                        e.target.nextElementSibling.value = found.id;
                        accordionItem.querySelector(
                            ".accordion-header .accordion-button"
                        ).innerText = `${exerciseOrder} ${found.name}`;
                    }
                }, 2000);
            }
        }
    }

    input(e) {
        if (e.target.classList.contains("exercise-name")) {
            const val = e.target.value;
            const accordionItem = util.getParentElement(
                e.target,
                "accordion-item"
            );
            const exerciseOrder = accordionItem.querySelector(
                "input[name*='order']"
            ).value;
            if (this.eventSource === "list") {
                this.exerciseDataListOptions.filter((option) => {
                    if (option.value == val) {
                        e.target.nextElementSibling.value =
                            option.dataset.value;
                        accordionItem.querySelector(
                            ".accordion-header .accordion-button"
                        ).innerText = `${exerciseOrder} ${option.value}`;
                    }
                });
            }
        }
    }
}
export default ExerciseInput;
