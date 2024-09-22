document.addEventListener('DOMContentLoaded', function () {
    initAdmin();
});

function initAdmin() {
    const admin = {
        ajax: {
            init() {
                this.bindEvents();
                const url = window.location.href;
                this.navigate(url);
                admin.menu.setActive(url);
            },
            bindEvents() {
                document.addEventListener('click', function (event) {
                    if (event.target.matches('a[href], a[href] *')) {
                        let a = event.target.closest('a');
                        let url = a.getAttribute('href');

                        if (url.charAt(0) !== '#' && !a.classList.contains('no-ajax')) {
                            admin.ajax.navigate(url);
                            admin.menu.setActive(url);
                            history.pushState(null, null, url);
                            event.preventDefault();
                        }
                    }
                });
                NProgress.configure({ parent: '#pjax-container' });
            },
            navigate(url) {
                NProgress.start();
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('app').innerHTML = data;
                        NProgress.done();
                        admin.pages.init();
                    })
                    .catch(error => console.error('Error fetching page:', error));
            }
        },
        pages: {
            init() {
                this.setTitle();
            },
            setTitle() {
                const titleEl = document.querySelector('main h1');
                if (titleEl) {
                    document.title = 'Admin | ' + titleEl.innerText;
                }
            }
        },
        menu: {
            setActive(url) {
                const menuItems = document.querySelectorAll('#navbar-sticky a');
                menuItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('href') === url) {
                        item.classList.add('active');
                    }
                });
            }
        }
    };

    admin.ajax.init();
    admin.pages.init();
}
