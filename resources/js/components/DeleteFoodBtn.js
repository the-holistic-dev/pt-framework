class DeleteFoodBtn {
    constructor() {
        this.btns = document.querySelectorAll(".delete-food");
        this.addEventListeners();
    }

    addEventListeners() {
        this.btns.forEach((btn) => {
            btn.addEventListener("click", this.click);
        });
    }

    click(e) {
        const mealAccordionBody = e.target.parentElement.parentElement;
        const foodNodes = mealAccordionBody.querySelectorAll(".food-row");
        if (foodNodes.length > 1) {
            const lastNode = foodNodes[foodNodes.length - 1];
            lastNode.remove();
        } else {
            const inputs =
                mealAccordionBody.querySelectorAll(".food-row input");
            inputs.forEach((input) => {
                input.value = "";
            });
        }
    }
}
export default DeleteFoodBtn;
