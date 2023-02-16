document.addEventListener("DOMContentLoaded", function() {
    let tabs = document.querySelectorAll(".tab-link:not(.desactive)");

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            unSelectAll();
            tab.classList.add("active");
            let ref = tab.getAttribute("data-ref");
            document
                .querySelector(`.tab-body[data-id="${ref}"]`)
                .classList.add("active");

            console.log(ref);

            let fond = document.getElementById("fond");


            if(ref==="connexion"){
                fond.style.height = "500px";
            }else{
                fond.style.height = "700px";
            }
        });

    });

    function unSelectAll() {
        tabs.forEach((tab) => {
            tab.classList.remove("active");
        });
        let tabbodies = document.querySelectorAll(".tab-body");
        tabbodies.forEach((tab) => {
            tab.classList.remove("active");
        });
    }

    document.querySelector(".tab-link.active").click();
});
