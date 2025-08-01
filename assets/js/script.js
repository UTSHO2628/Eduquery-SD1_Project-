document.addEventListener("DOMContentLoaded", function () {
    const roleButtons = document.querySelectorAll(".role-selector button");
    const roleInput = document.querySelector("input[name='role']");

    roleButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            roleButtons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");
            roleInput.value = this.dataset.role;
        });
    });
});
