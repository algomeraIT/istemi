document.addEventListener('DOMContentLoaded', function () {
    const arrowsInward = document.getElementById('arrows-inward');
    const arrowsOutward = document.getElementById('arrows-outward');
    const megaMenuButton = document.getElementById('mega-menu-button');
    const megaMenuContainer = document.getElementById('mega-menu-container');
    const expandButton = document.getElementById('expand-button');
    const expandedContent = document.getElementById('expanded-content');
    const menuContent = document.getElementById('menu-content');
    const hiddenDashboard = document.querySelector('.hiddenDashboard');
    const menuRows = document.querySelector('.menu-rows');
    const menuItems = document.querySelectorAll('.menu-item');
    const menuItemsInside = document.querySelectorAll('.menu-item-inside');
    const hideOnExplosion = document.querySelectorAll('.hide-on-explosion');
    const expandImages = document.querySelectorAll('.expand-images');
    const insideElement = document.querySelectorAll('.inside-element');

    let isMenuOpen = false;
    let isExpanded = false;

    megaMenuButton.addEventListener('click', function () {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
            megaMenuContainer.classList.remove('hidden');
            setTimeout(() => {
                megaMenuContainer.style.maxHeight = isExpanded ? '800px' : '500px';
            }, 10);
        } else {
            closeMenu();
        }
    });

    expandButton.addEventListener('click', function () {
        isExpanded = !isExpanded;

        if (isExpanded) {
            expandedContent.classList.remove('hidden');
            hiddenDashboard.classList.remove('hidden');
            
            expandImages.forEach(img => img.hidden = false);
            hideOnExplosion.forEach(el => el.hidden = true);
            menuItems.forEach(item => {
                item.style.display = "flex";
            });
            menuItemsInside.forEach(item => {
                item.style.padding = "10px";
                item.style.justifyItems = "center";
            });
            
            insideElement.forEach(item =>{
                item.classList.remove('pl-4');
            })

            menuRows.style.display = "list-item";
            menuRows.style.listStyle = "none";
            menuContent.style.justifySelf = "center";

            megaMenuContainer.style.maxHeight = '800px';

            toggleArrows(false);
        } else {
            megaMenuContainer.style.maxHeight = '500px';

            expandImages.forEach(img => img.hidden = true);
            hideOnExplosion.forEach(el => el.hidden = false);
            menuItems.forEach(item => item.style.display = "");
            menuItemsInside.forEach(item => {
                item.style.padding = "";
                item.style.justifyItems = "";
            });
            insideElement.forEach(item =>{
                item.classList.add('pl-4');
            })

            menuContent.style.removeProperty("justify-self");
            menuRows.style.removeProperty("display");
            menuRows.style.justifyItems = "start";

            hiddenDashboard.classList.add("hidden");

            setTimeout(() => {
                expandedContent.classList.add('hidden');
            }, 300);

            toggleArrows(true);
        }
    });

    document.addEventListener('click', function (event) {
        if (isMenuOpen && !megaMenuContainer.contains(event.target) && !megaMenuButton.contains(event.target)) {
            closeMenu();
        }
    });

    function closeMenu() {
        isMenuOpen = false;
        megaMenuContainer.style.maxHeight = '0';
        setTimeout(() => {
            megaMenuContainer.classList.add('hidden');
        }, 300);
    }

    function toggleArrows(showInward) {
        arrowsInward.classList.toggle('hidden', !showInward);
        arrowsInward.classList.toggle('block', showInward);
        arrowsOutward.classList.toggle('hidden', showInward);
        arrowsOutward.classList.toggle('block', !showInward);
    }
});