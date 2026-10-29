const navLinks = document.querySelectorAll(".nav-links a");
const sections = document.querySelectorAll("section");


navLinks.forEach(link => {

    link.addEventListener("click", () => {

        navLinks.forEach(item => {
            item.classList.remove("active");
        });

        link.classList.add("active");
    });

});


const observer = new IntersectionObserver((entries) => {

    entries.forEach(entry => {

        if (entry.isIntersecting) {

            navLinks.forEach(link => {
                link.classList.remove("active");
            });

            const activeLink = document.querySelector(
                `.nav-links a[href="#${entry.target.id}"]`
            );

            if (activeLink) {
                activeLink.classList.add("active");
            }
        }

    });

}, {
    threshold: 1
});

sections.forEach(section => {
    observer.observe(section);
});

        const btnFiltrar = document.getElementById('btnFiltrar');
        const searchInput = document.getElementById('searchInput');
        const emptyState = document.getElementById('emptyState');
        const questionsContainer = document.getElementById('questionsContainer');

        function dispararBusca() {
            emptyState.classList.add('g-hidden');
            questionsContainer.classList.remove('g-hidden');
        }

        btnFiltrar.addEventListener('click', dispararBusca);
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                dispararBusca();
            }
        });

        // Alternância exclusiva usando a nova classe protegida .g-selected
        const items = document.querySelectorAll('.g-alternative-item');
        items.forEach(item => {
            item.addEventListener('click', () => {
                items.forEach(i => i.classList.remove('g-selected'));
                item.add('g-selected');
            });
        });