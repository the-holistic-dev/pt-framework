import { util } from "../util";
class TemplateCategoryBtn {
    constructor() {
        this.editBtn = document.querySelector(".edit-category");
        this.deleteBtn = document.querySelector(".delete-category");
        if (this.editBtn && this.deleteBtn) {
            this.table = util.getParentElement(this.editBtn, "TABLE");
            this.initEventListener();
        }
    }

    initEventListener() {
        this.table.addEventListener("click", this.click);
    }

    async click(e) {
        console.log("Click");
        const form = e.target.parentElement;
        if (e.target.classList.contains("edit-category")) {
            const newCategory = prompt("Enter the new category name");
            if (newCategory) {
                e.target.nextElementSibling.value = newCategory;
                form.submit();
            }
        }

        if (e.target.classList.contains("delete-category")) {
            const confirm = window.confirm(
                "Are you sure you want to delete this category ?"
            );
            if (confirm) {
                form.submit();
            }
        }
    }
}
export default TemplateCategoryBtn;
