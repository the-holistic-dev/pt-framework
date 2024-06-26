class TemplateCategorySelect {
    constructor() {
        this.catSelect = document.getElementById("templateCatSelect");
        this.templateSelect = document.getElementById("templateSelect");
        if (this.catSelect) {
            this.addEventListener();
        }
    }

    addEventListener() {
        this.catSelect.addEventListener("change", this.selectChange.bind(this));
    }

    async selectChange(e) {
        const val = e.target.value;
        const model = e.target.dataset.model;
        const reponse = await fetch(`/api/${model}-templates/${val}`);
        const options = await reponse.json();
        this.templateSelect.innerHTML = "";
        options.forEach((option) => {
            const optionElement = document.createElement("option");
            optionElement.value = option.id;
            optionElement.text = option.title;
            this.templateSelect.options.add(optionElement);
        });
    }
}
export default TemplateCategorySelect;
