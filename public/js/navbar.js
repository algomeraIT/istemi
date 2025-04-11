
    document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById("userDropdownButton");
        const menu = document.getElementById("userDropdownMenu");

        if(typeof button != "undefined")
        {
            button.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevent click from bubbling up
                menu.classList.toggle("hidden");
            });
        }
    

        // Close dropdown when clicking outside
        document.addEventListener("click", function (event) {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add("hidden");
            }
        });
    });
