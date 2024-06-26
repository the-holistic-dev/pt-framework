import { util } from "../util";
class FoodGroupInput {
    constructor() {
        const foodGroupList = document.getElementById("foodGroupList");
        if (foodGroupList) {
            this.accordions = document.querySelectorAll(".accordion");
            this.foodGroupDataListOptions = Array.from(
                foodGroupList.querySelectorAll("option")
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
        if (e.target.classList.contains("group-name")) {
            this.eventSource = e.key ? "input" : "list";
            const groupNameInput = e.target;
            //enter
            if (e.key == 13) {
                this.timerId = null;
            }

            if (this.eventSource === "input" && e.target.value.length >= 2) {
                //backspace
                if (e.keyCode === 8) {
                    this.hideError(groupNameInput);
                } else {
                    const val = groupNameInput.value.toLowerCase();
                    const regex = new RegExp(`${val}`);
                    if (typeof this.timerId === "number") {
                        clearTimeout(this.timerId);
                    }
                    const element = this.foodGroupDataListOptions.find(
                        (option) => regex.test(option.value.toLowerCase())
                    );
                    this.timerId = setTimeout(async () => {
                        if (element) {
                            groupNameInput.value = element.value;
                            groupNameInput.nextElementSibling.value =
                                element.dataset.value;
                            const reponse = await fetch(
                                `/api/cnf-group/${element.dataset.value}`
                            );
                            const group = await reponse.json();
                            group.quantity = 1;
                            group.factor = 1;
                            const name = groupNameInput.nextElementSibling.name;
                            this.setGroupInStorage(group, name);
                        } else {
                            this.showError(groupNameInput);
                        }
                    }, 2000);
                }
            }
        }
    }

    async input(e) {
        if (e.target.classList.contains("group-name")) {
            const val = e.target.value;
            const groupIdInput = e.target.nextElementSibling;
            if (this.eventSource === "list") {
                let groupId = null;
                this.foodGroupDataListOptions.filter((option) => {
                    if (option.value == val) {
                        groupId = option.dataset.value;
                        e.target.nextElementSibling.value = groupId;
                    }
                });
                const reponse = await fetch(`/api/cnf-group/${groupId}`);
                const group = await reponse.json();
                group.quantity = 1;
                group.factor = 1;
                const name = groupIdInput.name;
                this.setGroupInStorage(group, name);
            }
        }
    }

    setGroupInStorage(group, name) {
        const dayIndex = util.getIndexForDay(name, "day");
        const mealIndex = util.getIndexForMealOrFood(name, "meal");
        const foodIndex = util.getIndexForMealOrFood(name, "group");
        util.addFoodToStorage(group, dayIndex, mealIndex, foodIndex);
    }

    showError(groupNameInput) {
        groupNameInput.classList.toggle("is-invalid", true);
        groupNameInput.nextElementSibling.nextElementSibling.classList.toggle(
            "d-none",
            false
        );
    }

    hideError(groupNameInput) {
        groupNameInput.classList.toggle("is-invalid", false);
        groupNameInput.nextElementSibling.nextElementSibling.classList.toggle(
            "d-none",
            true
        );
    }
}
export default FoodGroupInput;
