import axios from "axios";
class AddTemplateCategoryBtn {
    constructor() {
        this.btn = document.getElementById("addCatBtn");
        if (this.btn) {
            this.addEventListener();
        }
    }

    addEventListener() {
        this.btn.addEventListener("click", this.click.bind(this));
    }

    async click(e) {
        const name = prompt("Enter the new category name");
        if (name) {
            const data = { name: name };
            const response = await axios.post("/api/template-categories/", {
                headers: new Headers({
                    Accept: "application/json",
                }),
                data: data,
            });
            const { data: result } = await response;
            const categorySelect = document.querySelector(
                "select[name*='category']"
            );
            const optionElement = document.createElement("option");
            optionElement.value = result.id;
            optionElement.text = result.name;
            categorySelect.options.add(optionElement);
        }
    }
}
export default AddTemplateCategoryBtn;
