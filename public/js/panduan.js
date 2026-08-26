document.addEventListener('DOMContentLoaded', function () {

    const filterPills = document.querySelectorAll('.filter-pill');
    const articleItems = document.querySelectorAll('.article-item');
    const emptyState = document.getElementById('emptyState');

    filterPills.forEach((pill) => {
        pill.addEventListener('click', function () {
            filterPills.forEach((p) => p.classList.remove('is-active'));
            this.classList.add('is-active');

            const selected = this.getAttribute('data-filter');
            let visibleCount = 0;

            articleItems.forEach((item) => {
                const category = item.getAttribute('data-category');
                const isMatch = selected === 'semua' || category === selected;

                item.classList.toggle('is-hidden', !isMatch);
                if (isMatch) visibleCount++;
            });

            emptyState.classList.toggle('d-none', visibleCount !== 0);
        });
    });

});
