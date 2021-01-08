import $ from 'jquery';

class Nav {
    constructor() {
        this.menuIcon = $('.mobile-menu');
        this.bodyClass = $('body');
        this.sidebarTrigger = $('.js-sidebar');
        this.sidebarClose = $('.sidebar__close');
        this.sidebarNav = $('.sidebar--menu');
        this.sideBar = $('.sidebar');
        this.navLink = $('.js-popup');
        this.profileTrigger = $('.dropdown-toggle--profile');
        this.profileSidebar = $('.sidebar--profile');
        this.events();
    }

    events() {
        // this.menuIcon.click(this.toggleTheMenu.bind(this));
        this.sidebarTrigger.click(this.openCollapseMenu.bind(this));
        this.sidebarClose.click(this.closeCollapseMenu.bind(this));
        this.profileTrigger.click(this.showProfileNav.bind(this))
    }

    toggleTheMenu() {
        this.bodyClass.toggleClass('nav__open');
    }

    openCollapseMenu() {
        this.sidebarNav.addClass('sidebar--open');
    }

    closeCollapseMenu() {
        this.sideBar.removeClass('sidebar--open');
    }


    showProfileNav(){
        $(this.profileSidebar).addClass('sidebar--open')
    }

}

export default Nav;