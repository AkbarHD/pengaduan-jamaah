document.addEventListener('DOMContentLoaded', function () {
  // Navbar shadow saat scroll
  const navbar = document.querySelector('.site-navbar');
  if (navbar) {
    const toggleShadow = () => {
      if (window.scrollY > 8) {
        navbar.classList.add('is-scrolled');
      } else {
        navbar.classList.remove('is-scrolled');
      }
    };
    toggleShadow();
    window.addEventListener('scroll', toggleShadow);
  }

  // Auto highlight nav-link aktif berdasarkan URL saat ini
  const currentPath = window.location.pathname;
  document.querySelectorAll('.site-nav-link').forEach((link) => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });

  // Tutup navbar collapse otomatis saat link mobile diklik
  const navCollapse = document.getElementById('siteNavbarCollapse');
  if (navCollapse) {
    navCollapse.querySelectorAll('.site-nav-link').forEach((link) => {
      link.addEventListener('click', () => {
        const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
        if (bsCollapse) bsCollapse.hide();
      });
    });
  }
});
