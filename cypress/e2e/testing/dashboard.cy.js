import "cypress-file-upload";

describe("dashboard", () => {
    it("super-admin login", () => {
        cy.visit("http://127.0.0.1:8000/");
        cy.get(":nth-child(3) > .a-nav").click();
        cy.get(":nth-child(2) > .form-control").type("superadmin@gmail.com");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();
    });

    it("super-admin dashboard", () => {
        cy.get(".btn-danger > .fas").click();
        const fileName = "file/resi.pdf";
        cy.fixture(fileName).then((fileContent) => {
            cy.get("#file").attachFile({
                fileContent: fileContent.toString(),
                fileName: fileName,
                mimeType: "application/pdf",
            });
        });
        const fotoName = "foto/robot-2.png";
        cy.fixture(fotoName).then((fileContent) => {
            cy.get("#foto").attachFile({
                fileContent: fileContent.toString(),
                fileName: fotoName,
                mimeType: "application/png",
            });
        });
        cy.get("#judul").type(
            "Penerimaan Mahasiswa Baru Jalur Prestasi – Undangan Prodi D-III TPPU POLINEMA 2024"
        );
        cy.get("form > .btn").click();
    });

    it("super-admin dashboard", () => {
        cy.get(".text-right > .btn-primary > .fas").click();
        cy.get("#start").type("2024-05-10T08:00");
        cy.get("#end").type("2024-07-10T08:00");
        cy.get(":nth-child(4) > .btn").click();
    });
});
