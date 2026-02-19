document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("postForm");

    if (form) {
        form.addEventListener("submit", function (e) {

            const title = form.querySelector("input[name='title']").value.trim();
            const category = form.querySelector("input[name='category']").value.trim();
            const body = form.querySelector("textarea[name='body']").value.trim();

            if (title === "" || category === "" || body === "") {
                alert("All fields are required!");
                e.preventDefault();
            }
        });
    }
});
