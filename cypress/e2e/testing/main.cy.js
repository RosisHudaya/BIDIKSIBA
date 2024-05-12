describe("main", () => {
    it("super-admin login", () => {
        // login
        cy.visit("http://127.0.0.1:8000/");
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(".mb-0").should("have.text", "Welcome");
        cy.get(".s-b").contains("BIDIKSIBA");
        cy.get(".s-p").should("have.text", "POLINEMA");
        cy.get(":nth-child(2) > .form-control")
            .invoke("attr", "placeholder")
            .should("contains", "Email");
        cy.get(":nth-child(3) > .form-control")
            .invoke("attr", "placeholder")
            .should("contains", "Password");
        cy.get(".text-small").contains("Lupa password?");
        cy.get(".btn").contains("LOGIN").and("be.enabled");
        cy.get(".text-center").contains("Belum punya akun? Buat");
        cy.get(".a-href").contains("Buat").should("have.attr", "href");

        // failed login
        cy.get(".btn").click();
        cy.get(":nth-child(2) > .invalid-feedback").contains(
            "The email field is required"
        );
        cy.get(":nth-child(3) > .invalid-feedback").contains(
            "The password field is required"
        );

        // success login
        cy.get(":nth-child(2) > .form-control").type("superadmin@gmail.com");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();

        // dashboard
        cy.get(":nth-child(2) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        cy.get(":nth-child(3) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(4) > .nav-link").click();

        cy.get(":nth-child(4) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        cy.get(":nth-child(5) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();

        cy.get(":nth-child(6) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        cy.get(":nth-child(7) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        cy.get(":nth-child(8) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        // logout
        cy.get(".navbar-right > .dropdown > .nav-link").click();
        cy.get(".text-danger").click();
    });

    it("admin-bidiksiba login", () => {
        // login
        cy.visit("http://127.0.0.1:8000/");
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(2) > .form-control").type("bidiksiba@gmail.com");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();

        // dashboard
        cy.get(":nth-child(2) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();

        cy.get(":nth-child(3) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(4) > .nav-link").click();

        cy.get(":nth-child(4) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        cy.get(":nth-child(5) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        cy.get(":nth-child(6) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();

        // logout
        cy.get(".navbar-right > .dropdown > .nav-link").click();
        cy.get(".text-danger").click();
    });

    it("calon-mahasiswa login", () => {
        // login
        cy.visit("http://127.0.0.1:8000/");
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(2) > .form-control").type("siswa@gmail.com");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();

        // nav-bar
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(4) > .a-nav").click();
        cy.get(":nth-child(5) > .a-nav").click();
        cy.get(":nth-child(6) > .a-nav").click();
    });

    it("pengawas login", () => {
        // login
        cy.visit("http://127.0.0.1:8000/");
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(2) > .form-control").type("pengawas@gmail.com");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();

        // nav-bar
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(4) > .a-nav").click();
    });
});
