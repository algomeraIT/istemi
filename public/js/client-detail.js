document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".tab-button");
    const contents = document.querySelectorAll(".tab-content");

    function activateTab(targetId) {
        contents.forEach(content => content.classList.add("hidden"));
        buttons.forEach(btn => btn.classList.remove("text-cyan-500", "border-cyan-500"));

        document.getElementById(targetId).classList.remove("hidden");
        document.querySelector(`[data-target="${targetId}"]`).classList.add("text-cyan-500", "border-cyan-500");
    }

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            activateTab(this.getAttribute("data-target"));
        });
    });

    activateTab("referent");


    const tabs = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('transitionend', function () {
            if (tab.id === 'sale') {
              
                Livewire.emit('reloadSalesComponent');
            }
        });
    });


});

