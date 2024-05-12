describe("list-user", () => {
    it("super-admin login", () => {
        cy.visit("http://127.0.0.1:8000/");
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(2) > .form-control").type("superadmin@gmail.com");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();

        // tambah user
        cy.get(":nth-child(2) > .has-dropdown").click();
        cy.get(".active > .dropdown-menu > :nth-child(1) > .nav-link").click();
        cy.get(".header > .btn").click();
        cy.get("#name").type("User black box");
        cy.get("#email").type("black@gmail.com");
        cy.get("#password").type("password");
        cy.get("#select2-user_type-container").click();
        cy.get("#select2-user_type-container").type("Calon Mahasiswa{enter}");
        cy.get(".btn-primary").click();
        cy.get("#success-alert").contains("User baru Berhasil Ditambahkan");

        // verifikasi user
        cy.get("#vel-5 > .btn").click();
        cy.get(
            "#fire-modal-9 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get("#success-alert").contains("Akun telah berhasil diverifikasi");
    });
});
