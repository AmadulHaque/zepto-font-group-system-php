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
                            admin.routes.navigate(url);
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
        },
        routes: {
            paths: {},
            define(path, handler) {
                this.paths[path] = handler;
            },
            navigate(path) {
                if (this.paths[path]) {
                    this.paths[path](); // Call the associated handler
                } else {
                    console.warn('Route not defined for path:', path);
                }
            }
        }
    };

    // Define your routes here
    admin.routes.define('/', () => admin.ajax.navigate('/'));
    admin.routes.define('/font/create', () => admin.ajax.navigate('/font/create'));
    admin.routes.define('/font/group', () => admin.ajax.navigate('/font/group'));
    admin.routes.define('/font/group/create', () => admin.ajax.navigate('/font/group/create'));
    

    admin.ajax.init();
    admin.pages.init();
}

function navigate(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('app').innerHTML = data; 
        })
        .catch(error => console.error('Error fetching page:', error));
}
