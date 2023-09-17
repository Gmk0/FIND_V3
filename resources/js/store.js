

export default {
    isDarkModeEnabled: false,
    isMonochromeModeEnabled: false,
    isSearchbarActive: false,
    isSidebarExpanded: false,
    isRightSidebarExpanded: false,
    loading: true,


    init() {
        let firstTime = true;

        // Initialisation à partir de localStorage



        this.isDarkModeEnabled = JSON.parse(localStorage.getItem("_x_darkMode_on") || "false");





        this.isSidebarExpanded =
            document.querySelector(".sidebar") &&
            document.body.classList.contains("is-sidebar-open") &&
            Alpine.store("breakpoints").xlAndUp;

        // Mettre à jour localStorage chaque fois que isDarkModeEnabled change
        Alpine.effect(() => {

            this.isDarkModeEnabled
                ? document.documentElement.classList.add("dark")
                : document.documentElement.classList.remove("dark");


            localStorage.setItem("_x_darkMode_on", JSON.stringify(this.isDarkModeEnabled));
        });
        Alpine.effect(() => {
            this.isMonochromeModeEnabled
                ? document.body.classList.add("is-monochrome")
                : document.body.classList.remove("is-monochrome");
        });

        Alpine.effect(() => {
            this.isSidebarExpanded
                ? document.body.classList.add("is-sidebar-open")
                : document.body.classList.remove("is-sidebar-open");
        });

        Alpine.effect(() => {
            if (Alpine.store("breakpoints").name && !firstTime) {
                this.isSidebarExpanded = false;
                this.isRightSidebarExpanded = false;
            }
        });


        Alpine.effect(() => {
            if (Alpine.store("breakpoints").smAndUp) this.isSearchbarActive = false;
        });

        firstTime = false


    },


};
